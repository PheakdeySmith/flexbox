<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $subscriberRole = Role::firstOrCreate(['name' => 'subscriber']);

        // Create permissions
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage subscriptions',
            'access premium content',
            'view content',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['view content']);
        $subscriberRole->givePermissionTo(['view content', 'access premium content']);
    }
}
