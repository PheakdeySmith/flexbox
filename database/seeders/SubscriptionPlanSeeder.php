<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing plans
        // SubscriptionPlan::truncate();

        // Free Plan
        SubscriptionPlan::create([
            'name' => 'Free Plan',
            'slug' => 'free-plan',
            'description' => 'Basic features for getting started',
            'price' => 0.00,
            'billing_cycle' => 'monthly',
            'duration_in_days' => 30,
            'has_trial' => false,
            'trial_days' => 0,
            'is_active' => true,
            'features' => [
                'Basic access',
                'Limited storage',
                'Email support'
            ],
        ]);

        // Standard Plan ($10/month)
        SubscriptionPlan::create([
            'name' => 'Standard Plan',
            'slug' => 'standard-plan',
            'description' => 'Enhanced features for regular users',
            'price' => 10.00,
            'billing_cycle' => 'monthly',
            'duration_in_days' => 30,
            'has_trial' => true,
            'trial_days' => 7,
            'is_active' => true,
            'features' => [
                'All Free features',
                'Increased storage',
                'Priority support',
                'Advanced features'
            ],
        ]);

        // Premium Lifetime Plan ($199 one-time)
        SubscriptionPlan::create([
            'name' => 'Premium Lifetime',
            'slug' => 'premium-lifetime',
            'description' => 'All premium features forever with one payment',
            'price' => 199.00,
            'billing_cycle' => 'lifetime',
            'duration_in_days' => 36500, // ~100 years (effectively forever)
            'has_trial' => false,
            'trial_days' => 0,
            'is_active' => true,
            'features' => [
                'All Standard features',
                'Unlimited storage',
                '24/7 priority support',
                'All premium features',
                'Early access to new features',
                'No recurring payments'
            ],
        ]);
    }
}