<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'plan'])->latest()->paginate(10);
        return view('backend.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $subscriptionPlans = SubscriptionPlan::active()->get();
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

        if ($hasActiveSubscription) {
            return redirect()->back()->with('error', 'This user already has an active subscription.');
        }

        Subscription::create([
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

        return redirect()->route('subscription.index')->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'plan', 'payments']);
        return view('backend.subscription.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $users = User::all();
        $subscriptionPlans = SubscriptionPlan::active()->get();
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
            return redirect()->back()->with('error', 'This user already has an active subscription.');
        }

        $subscription->update([
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

        return redirect()->route('subscription.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscription.index')->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Cancel a subscription.
     */
    public function cancel(Subscription $subscription)
    {
        $subscription->cancel();
        return redirect()->back()->with('success', 'Subscription canceled successfully.');
    }

    /**
     * Extend a subscription.
     */
    public function extend(Request $request, Subscription $subscription)
    {
        $request->validate([
            'days' => 'required|integer|min:1',
        ]);

        $newEndDate = Carbon::parse($subscription->end_date)->addDays($request->days);

        $subscription->update([
            'end_date' => $newEndDate,
        ]);

        return redirect()->back()->with('success', "Subscription extended by {$request->days} days.");
    }
}
