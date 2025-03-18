<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define resources for which we'll create permissions
        $resources = [
            'dashboard',
            'user',
            'role',
            'movie',
            'genre',
            'actor',
            'director',
            'review',
            'favorite',
            'playlist',
            'watchlist',
            'order',
            'payment',
            'subscription',
            'subscription-plan',
            'report',
            'settings',
        ];

        // Define permission types
        $permissionTypes = [
            'view',
            'create',
            'edit',
            'delete',
            'manage',
        ];

        // Create basic permissions for each resource
        $allPermissions = [];
        foreach ($resources as $resource) {
            foreach ($permissionTypes as $permissionType) {
                $permissionName = $permissionType . ' ' . $resource;
                Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
                $allPermissions[] = $permissionName;
            }
        }

        // Create special permissions
        $specialPermissions = [
            'access backend',
            'view reports',
            'generate reports',
            'manage settings',
            'view analytics',
            'update movie status',
            'approve reviews',
            'manage subscriptions',
            'process payments',
            'issue refunds',
            'cancel subscriptions',
            'extend subscriptions',
        ];

        foreach ($specialPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            $allPermissions[] = $permission;
        }

        // Get roles (already seeded)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $subscriberRole = Role::firstOrCreate(['name' => 'subscriber', 'guard_name' => 'web']);
        $memberRole = Role::firstOrCreate(['name' => 'member', 'guard_name' => 'web']);

        // Admin gets all permissions
        $adminRole->syncPermissions($allPermissions);

        // User limited permissions
        $userRole->syncPermissions([
            'view movie',
            'view genre',
            'view actor',
            'view director',
            'view review',
            'create review',
            'edit review',
            'delete review',
            'view favorite',
            'create favorite',
            'delete favorite',
            'view watchlist',
            'create watchlist',
            'delete watchlist',
            'view playlist',
            'create playlist',
            'edit playlist',
            'delete playlist',
            'view order',
            'create order',
            'view payment',
        ]);

        // Subscriber permissions (all user permissions plus some extras)
        $subscriberPermissions = $userRole->permissions->pluck('name')->toArray();
        $subscriberPermissions = array_merge($subscriberPermissions, [
            'view subscription',
            'cancel subscriptions',
        ]);
        $subscriberRole->syncPermissions($subscriberPermissions);

        // Member permissions (similar to subscriber)
        $memberPermissions = $subscriberRole->permissions->pluck('name')->toArray();
        $memberRole->syncPermissions($memberPermissions);

        $this->command->info('Permissions seeded successfully!');
    }
}
