<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = SubscriptionPlan::latest()->paginate(10);
        return view('backend.subscription_plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.subscription_plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:subscription_plans',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,biannually,annually,lifetime',
            'duration_in_days' => 'required|integer|min:1',
            'has_trial' => 'boolean',
            'trial_days' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'features' => 'nullable|string',
        ]);

        // Generate slug if not provided
        $slug = $request->slug ?? Str::slug($request->name);

        // Process features from textarea to array
        $features = [];
        if ($request->features) {
            $features = array_filter(explode("\n", $request->features), function($line) {
                return trim($line) !== '';
            });

            // Trim each feature
            $features = array_map('trim', $features);
        }

        SubscriptionPlan::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'duration_in_days' => $request->duration_in_days,
            'has_trial' => $request->has_trial ?? false,
            'trial_days' => $request->has_trial ? ($request->trial_days ?? 0) : 0,
            'is_active' => $request->is_active ?? true,
            'features' => $features,
        ]);

        return redirect()->route('subscription-plan.index')
            ->with('success', 'Subscription plan created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create subscription plan. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->load(['subscriptions' => function($query) {
            $query->with('user')->latest()->take(10);
        }]);

        $activeSubscriptionsCount = $subscriptionPlan->subscriptions()->active()->count();
        $totalSubscriptionsCount = $subscriptionPlan->subscriptions()->count();

        return view('backend.subscription_plan.show', compact(
            'subscriptionPlan',
            'activeSubscriptionsCount',
            'totalSubscriptionsCount'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        // Convert features array to string for textarea
        if (is_array($subscriptionPlan->features)) {
            $subscriptionPlan->features_text = implode("\n", $subscriptionPlan->features);
        } else {
            $subscriptionPlan->features_text = '';
        }

        return view('backend.subscription_plan.edit', compact('subscriptionPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:subscription_plans,slug,' . $subscriptionPlan->id,
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,biannually,annually,lifetime',
            'duration_in_days' => 'required|integer|min:1',
            'has_trial' => 'boolean',
            'trial_days' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'features' => 'nullable|string',
        ]);

        // Generate slug if not provided
        $slug = $request->slug ?? Str::slug($request->name);

        // Process features from textarea to array
        $features = [];
        if ($request->features) {
            $features = array_filter(explode("\n", $request->features), function($line) {
                return trim($line) !== '';
            });

            // Trim each feature
            $features = array_map('trim', $features);
        }

        $subscriptionPlan->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'duration_in_days' => $request->duration_in_days,
            'has_trial' => $request->has_trial ?? false,
            'trial_days' => $request->has_trial ? ($request->trial_days ?? 0) : 0,
            'is_active' => $request->is_active ?? true,
            'features' => $features,
        ]);

        return redirect()->route('subscription-plan.index')
            ->with('success', 'Subscription plan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update subscription plan. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        // Check if the plan has active subscriptions
        $hasActiveSubscriptions = $subscriptionPlan->subscriptions()->active()->exists();

        if ($hasActiveSubscriptions) {
            return redirect()->back()
                ->with('error', 'Cannot delete a plan with active subscriptions.');
        }

        $subscriptionPlan->delete();

        return redirect()->route('subscription-plan.index')
            ->with('success', 'Subscription plan deleted successfully.');
    }

    /**
     * Toggle the active status of a subscription plan.
     */
    public function toggleActive(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->update([
            'is_active' => !$subscriptionPlan->is_active,
        ]);

        $status = $subscriptionPlan->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Subscription plan {$status} successfully.");
    }
}
