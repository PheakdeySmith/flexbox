<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subscription::with(['user', 'plan']);

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by user if provided
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by plan if provided
        if ($request->has('plan_id') && $request->plan_id) {
            $query->where('subscription_plan_id', $request->plan_id);
        }

        $subscriptions = $query->latest()->paginate(10);

        // Get data for filters
        $users = User::orderBy('name')->get(['id', 'name']);
        $plans = SubscriptionPlan::orderBy('name')->get(['id', 'name']);

        return view('backend.subscription.index', compact('subscriptions', 'users', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $subscriptionPlans = SubscriptionPlan::active()->orderBy('name')->get();
        return view('backend.subscription.create', compact('users', 'subscriptionPlans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'status' => 'required|in:active,canceled,expired',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'trial_ends_at' => 'nullable|date|after_or_equal:start_date|before_or_equal:end_date',
            'auto_renew' => 'boolean',
            'stripe_id' => 'nullable|string',
            'stripe_status' => 'nullable|string',
            'stripe_price' => 'nullable|string',
        ]);

        // Check if the user already has an active subscription
        $hasActiveSubscription = Subscription::where('user_id', $request->user_id)
            ->where('status', 'active')
            ->exists();

        if ($hasActiveSubscription && $request->status === 'active') {
            return redirect()->back()
                ->with('error', 'This user already has an active subscription.')
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Create the subscription
            $subscription = Subscription::create([
                'user_id' => $request->user_id,
                'subscription_plan_id' => $request->subscription_plan_id,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'trial_ends_at' => $request->trial_ends_at,
                'auto_renew' => $request->auto_renew ?? false,
                'stripe_id' => $request->stripe_id,
                'stripe_status' => $request->stripe_status,
                'stripe_price' => $request->stripe_price,
            ]);

            // Get the subscription plan
            $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

            // Create a payment record if status is active
            if ($request->status === 'active') {
                $payment = Payment::create([
                    'user_id' => $request->user_id,
                    'subscription_id' => $subscription->id,
                    'payment_method' => 'admin',
                    'payment_type' => 'subscription',
                    'amount' => $plan->price,
                    'currency' => 'USD',
                    'status' => 'completed',
                    'notes' => 'Created by admin',
                ]);

                // Create payment detail
                PaymentDetail::create([
                    'payment_id' => $payment->id,
                    'payable_id' => $subscription->id,
                    'payable_type' => Subscription::class,
                ]);
            }

            DB::commit();

            return redirect()->route('subscription.index')
                ->with('success', 'Subscription created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to create subscription: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'plan', 'payments']);

        // Get payment history
        $payments = Payment::where('subscription_id', $subscription->id)
            ->latest()
            ->get();

        return view('backend.subscription.show', compact('subscription', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $users = User::orderBy('name')->get();
        $subscriptionPlans = SubscriptionPlan::orderBy('name')->get();
        return view('backend.subscription.edit', compact('subscription', 'users', 'subscriptionPlans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'status' => 'required|in:active,canceled,expired',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'trial_ends_at' => 'nullable|date|after_or_equal:start_date|before_or_equal:end_date',
            'auto_renew' => 'boolean',
            'stripe_id' => 'nullable|string',
            'stripe_status' => 'nullable|string',
            'stripe_price' => 'nullable|string',
        ]);

        // Check if another user has an active subscription with the same user_id
        $hasActiveSubscription = Subscription::where('user_id', $request->user_id)
            ->where('status', 'active')
            ->where('id', '!=', $subscription->id)
            ->exists();

        if ($hasActiveSubscription && $request->status === 'active') {
            return redirect()->back()
                ->with('error', 'This user already has an active subscription.')
                ->withInput();
        }

        // Set canceled_at if status changed to canceled
        $canceled_at = null;
        if ($request->status === 'canceled' && $subscription->status !== 'canceled') {
            $canceled_at = now();
        }

        $subscription->update([
            'user_id' => $request->user_id,
            'subscription_plan_id' => $request->subscription_plan_id,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'trial_ends_at' => $request->trial_ends_at,
            'auto_renew' => $request->auto_renew ?? false,
            'canceled_at' => $canceled_at,
            'stripe_id' => $request->stripe_id,
            'stripe_status' => $request->stripe_status,
            'stripe_price' => $request->stripe_price,
        ]);

        return redirect()->route('subscription.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        // Check if the subscription has payments
        $hasPayments = Payment::where('subscription_id', $subscription->id)->exists();

        if ($hasPayments) {
            return redirect()->back()
                ->with('error', 'Cannot delete a subscription with payment records. Cancel it instead.');
        }

        $subscription->delete();

        return redirect()->route('subscription.index')
            ->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Cancel a subscription.
     */
    public function cancel(Subscription $subscription)
    {
        if ($subscription->status === 'canceled') {
            return redirect()->back()
                ->with('info', 'Subscription is already canceled.');
        }

        $subscription->cancel();

        return redirect()->back()
            ->with('success', 'Subscription canceled successfully.');
    }

    /**
     * Extend a subscription.
     */
    public function extend(Request $request, Subscription $subscription)
    {
        $request->validate([
            'days' => 'required|integer|min:1',
        ]);

        if ($subscription->status !== 'active') {
            return redirect()->back()
                ->with('error', 'Only active subscriptions can be extended.');
        }

        $newEndDate = Carbon::parse($subscription->end_date)->addDays($request->days);

        $subscription->update([
            'end_date' => $newEndDate,
        ]);

        // Create a note about the extension
        $note = "Subscription extended by {$request->days} days by admin.";

        // Log this action
        Log::info('Subscription extended', [
            'subscription_id' => $subscription->id,
            'days' => $request->days,
            'new_end_date' => $newEndDate->format('Y-m-d'),
            'user_id' => $subscription->user_id
        ]);

        return redirect()->back()
            ->with('success', "Subscription extended by {$request->days} days.");
    }
}
