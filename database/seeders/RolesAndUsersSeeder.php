<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $memberRole = Role::create(['name' => 'member']);
        $userRole = Role::create(['name' => 'user']);

        // Create users
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('11111111'),
            'user_profile' => null,
        ]);
        $adminUser->assignRole($adminRole);

        $memberUser = User::create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => bcrypt('11111111'),
            'user_profile' => null,
        ]);
        $memberUser->assignRole($memberRole);

        $normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('11111111'),
            'user_profile' => null,
        ]);
        $normalUser->assignRole($userRole);
    }
}
