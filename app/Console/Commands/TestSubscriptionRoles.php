<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Services\SubscriptionRoleService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestSubscriptionRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:subscription-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the subscription role management system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting subscription role management test...');

        // Create a test user
        $user = new User();
        $user->name = 'Test Subscriber';
        $user->email = 'test.subscriber@example.com';
        $user->password = Hash::make('password');
        $user->save();

        $this->info("Created user: {$user->name} (ID: {$user->id})");

        // Assign the user role
        $user->assignRole('user');
        $this->info("Assigned 'user' role");

        // Get a subscription plan
        $plan = SubscriptionPlan::first();

        if ($plan) {
            $this->info("Found plan: {$plan->name} (ID: {$plan->id})");

            // Create a subscription for the user
            $subscription = new Subscription();
            $subscription->user_id = $user->id;
            $subscription->subscription_plan_id = $plan->id;
            $subscription->status = 'active';
            $subscription->start_date = now();
            $subscription->end_date = now()->addDays(30);
            $subscription->save();

            $this->info("Created subscription for user {$user->name}");

            // Update the user's role based on subscription
            $roleService = new SubscriptionRoleService();
            $roleService->updateUserRole($user);

            // Refresh the user and check roles
            $user->refresh();
            $this->info("User roles after subscription: " . implode(', ', $user->getRoleNames()->toArray()));

            // Cancel the subscription
            $subscription->status = 'canceled';
            $subscription->canceled_at = now();
            $subscription->save();

            $this->info("Canceled subscription for user {$user->name}");

            // Update the user's role again
            $roleService->updateUserRole($user);

            // Refresh the user and check roles
            $user->refresh();
            $this->info("User roles after cancellation: " . implode(', ', $user->getRoleNames()->toArray()));

            // Clean up - delete the test user and subscription
            $subscription->delete();
            $user->delete();

            $this->info("Test completed and cleaned up.");
            return Command::SUCCESS;
        } else {
            $this->error("No subscription plans found. Please run the SubscriptionPlanSeeder first.");
            return Command::FAILURE;
        }
    }
}
