<?php

namespace App\Services;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionRoleService
{
    /**
     * Update the user's role based on their subscription status.
     *
     * @param User $user
     * @return void
     */
    public function updateUserRole(User $user)
    {
        // Check if user has any active subscription
        $hasActiveSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->exists();

        // Get the current roles the user has
        $currentRoles = $user->roles->pluck('name')->toArray();

        // Define the subscriber role name
        $subscriberRole = 'subscriber';

        // Begin transaction to ensure role changes are atomic
        DB::beginTransaction();

        try {
            if ($hasActiveSubscription) {
                // If user has active subscription but doesn't have subscriber role, add it
                if (!in_array($subscriberRole, $currentRoles)) {
                    $user->assignRole($subscriberRole);
                }
            } else {
                // If user doesn't have active subscription but has subscriber role, remove it
                if (in_array($subscriberRole, $currentRoles)) {
                    $user->removeRole($subscriberRole);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update user role: ' . $e->getMessage());
        }
    }

    /**
     * Update roles for all users based on their subscription status.
     * This can be used in a scheduled command to ensure roles are correct.
     *
     * @return void
     */
    public function updateAllUserRoles()
    {
        // Get all users with the subscriber role
        $subscriberUsers = User::role('subscriber')->get();

        // Get all users with active subscriptions
        $activeSubscriptionUserIds = Subscription::where('status', 'active')
            ->where('end_date', '>', now())
            ->pluck('user_id')
            ->unique()
            ->toArray();

        $activeSubscriptionUsers = User::whereIn('id', $activeSubscriptionUserIds)->get();

        // Process each subscriber to check if they should still have the role
        foreach ($subscriberUsers as $user) {
            if (!in_array($user->id, $activeSubscriptionUserIds)) {
                $user->removeRole('subscriber');
            }
        }

        // Process each user with active subscription to ensure they have the role
        foreach ($activeSubscriptionUsers as $user) {
            if (!$user->hasRole('subscriber')) {
                $user->assignRole('subscriber');
            }
        }
    }
}
