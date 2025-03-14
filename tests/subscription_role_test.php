<?php

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Services\SubscriptionRoleService;

// Create a test user
$user = new User();
$user->name = 'Test Subscriber';
$user->email = 'test.subscriber@example.com';
$user->password = bcrypt('password');
$user->save();

echo "Created user: {$user->name} (ID: {$user->id})\n";

// Assign the user role
$user->assignRole('user');
echo "Assigned 'user' role\n";

// Get a subscription plan
$plan = SubscriptionPlan::first();

if ($plan) {
    echo "Found plan: {$plan->name} (ID: {$plan->id})\n";

    // Create a subscription for the user
    $subscription = new Subscription();
    $subscription->user_id = $user->id;
    $subscription->subscription_plan_id = $plan->id;
    $subscription->status = 'active';
    $subscription->start_date = now();
    $subscription->end_date = now()->addDays(30);
    $subscription->save();

    echo "Created subscription for user {$user->name}\n";

    // Update the user's role based on subscription
    $roleService = new SubscriptionRoleService();
    $roleService->updateUserRole($user);

    // Refresh the user and check roles
    $user->refresh();
    echo "User roles after subscription: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";

    // Cancel the subscription
    $subscription->status = 'canceled';
    $subscription->canceled_at = now();
    $subscription->save();

    echo "Canceled subscription for user {$user->name}\n";

    // Update the user's role again
    $roleService->updateUserRole($user);

    // Refresh the user and check roles
    $user->refresh();
    echo "User roles after cancellation: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";

    // Clean up - delete the test user and subscription
    $subscription->delete();
    $user->delete();

    echo "Test completed and cleaned up.\n";
} else {
    echo "No subscription plans found. Please run the SubscriptionPlanSeeder first.\n";
}
