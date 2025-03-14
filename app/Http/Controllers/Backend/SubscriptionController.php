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
            // Get the subscription plan
            $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

            // Check if this is a lifetime plan (36500 days or more)
            $isLifetimePlan = $plan->duration_in_days >= 36500;

            // For lifetime plans, use a more reasonable end date (10 years from start)
            if ($isLifetimePlan) {
                $startDate = Carbon::parse($request->start_date);
                // Use 10 years instead of 100 years to stay well within MySQL's datetime limits
                $endDate = $startDate->copy()->addYears(10);
            } else {
                // For regular plans, use the provided end date
                $endDate = Carbon::parse($request->end_date);
            }

            // Format dates for MySQL
            $formattedEndDate = $endDate->format('Y-m-d H:i:s');
            $formattedStartDate = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
            $formattedTrialEndsAt = $request->trial_ends_at
                ? Carbon::parse($request->trial_ends_at)->format('Y-m-d H:i:s')
                : null;
            $formattedCreatedAt = now()->format('Y-m-d H:i:s');
            $formattedUpdatedAt = $formattedCreatedAt;

            // Log the formatted date for debugging
            Log::info('Creating subscription with end date', [
                'user_id' => $request->user_id,
                'plan_id' => $request->subscription_plan_id,
                'formatted_end_date' => $formattedEndDate,
                'formatted_start_date' => $formattedStartDate
            ]);

            // Use a raw query with proper bindings to ensure dates are quoted correctly
            DB::insert(
                'INSERT INTO subscriptions
                (user_id, subscription_plan_id, status, start_date, end_date, trial_ends_at, auto_renew, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $request->user_id,
                    $request->subscription_plan_id,
                    $request->status,
                    $formattedStartDate,
                    $formattedEndDate,
                    $formattedTrialEndsAt,
                    $request->auto_renew ?? false,
                    $formattedCreatedAt,
                    $formattedUpdatedAt
                ]
            );

            // Get the ID of the last inserted record
            $subscriptionId = DB::getPdo()->lastInsertId();

            // Retrieve the created subscription
            $subscription = Subscription::findOrFail($subscriptionId);

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

            Log::error('Error creating subscription', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $request->user_id,
                'plan_id' => $request->subscription_plan_id
            ]);

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

        try {
            // Get the subscription plan
            $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

            // Check if this is a lifetime plan (36500 days or more)
            $isLifetimePlan = $plan->duration_in_days >= 36500;

            // For lifetime plans, use a more reasonable end date (10 years from start)
            if ($isLifetimePlan) {
                $startDate = Carbon::parse($request->start_date);
                // Use 10 years instead of 100 years to stay well within MySQL's datetime limits
                $endDate = $startDate->copy()->addYears(10);
            } else {
                // For regular plans, use the provided end date
                $endDate = Carbon::parse($request->end_date);
            }

            // Format the end date for MySQL
            $formattedEndDate = $endDate->format('Y-m-d H:i:s');
            $formattedStartDate = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
            $formattedTrialEndsAt = $request->trial_ends_at ? Carbon::parse($request->trial_ends_at)->format('Y-m-d H:i:s') : null;
            $formattedCanceledAt = $canceled_at ? $canceled_at->format('Y-m-d H:i:s') : null;
            $formattedUpdatedAt = now()->format('Y-m-d H:i:s');

            // Log the formatted date for debugging
            Log::info('Updating subscription with end date', [
                'subscription_id' => $subscription->id,
                'formatted_end_date' => $formattedEndDate,
                'formatted_start_date' => $formattedStartDate
            ]);

            // Use a raw query with proper bindings to ensure dates are quoted correctly
            DB::update(
                'UPDATE subscriptions SET
                user_id = ?,
                subscription_plan_id = ?,
                status = ?,
                start_date = ?,
                end_date = ?,
                trial_ends_at = ?,
                auto_renew = ?,
                canceled_at = ?,
                updated_at = ?
                WHERE id = ?',
                [
                    $request->user_id,
                    $request->subscription_plan_id,
                    $request->status,
                    $formattedStartDate,
                    $formattedEndDate,
                    $formattedTrialEndsAt,
                    $request->auto_renew ?? false,
                    $formattedCanceledAt,
                    $formattedUpdatedAt,
                    $subscription->id
                ]
            );

            return redirect()->route('subscription.index')
                ->with('success', 'Subscription updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating subscription', [
                'subscription_id' => $subscription->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update subscription: ' . $e->getMessage())
                ->withInput();
        }
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

        try {
            // Format dates for MySQL
            $formattedCanceledAt = now()->format('Y-m-d H:i:s');
            $formattedUpdatedAt = $formattedCanceledAt;

            // Use a raw query with proper bindings to ensure dates are quoted correctly
            DB::update(
                'UPDATE subscriptions SET
                status = ?,
                canceled_at = ?,
                auto_renew = ?,
                updated_at = ?
                WHERE id = ?',
                [
                    'canceled',
                    $formattedCanceledAt,
                    false,
                    $formattedUpdatedAt,
                    $subscription->id
                ]
            );

            return redirect()->back()
                ->with('success', 'Subscription canceled successfully.');
        } catch (\Exception $e) {
            Log::error('Error canceling subscription', [
                'subscription_id' => $subscription->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
        }
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

        try {
            $newEndDate = Carbon::parse($subscription->end_date)->addDays($request->days);

            // Format dates for MySQL
            $formattedEndDate = $newEndDate->format('Y-m-d H:i:s');
            $formattedUpdatedAt = now()->format('Y-m-d H:i:s');

            // Log the extension for debugging
            Log::info('Extending subscription', [
                'subscription_id' => $subscription->id,
                'days_added' => $request->days,
                'original_end_date' => $subscription->end_date->format('Y-m-d H:i:s'),
                'new_end_date' => $formattedEndDate
            ]);

            // Use a raw query with proper bindings to ensure dates are quoted correctly
            DB::update(
                'UPDATE subscriptions SET
                end_date = ?,
                updated_at = ?
                WHERE id = ?',
                [
                    $formattedEndDate,
                    $formattedUpdatedAt,
                    $subscription->id
                ]
            );

            return redirect()->back()
                ->with('success', "Subscription extended by {$request->days} days.");
        } catch (\Exception $e) {
            Log::error('Error extending subscription', [
                'subscription_id' => $subscription->id,
                'days' => $request->days,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to extend subscription: ' . $e->getMessage());
        }
    }
}
