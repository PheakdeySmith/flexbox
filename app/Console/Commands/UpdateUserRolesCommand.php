<?php

namespace App\Console\Commands;

use App\Services\SubscriptionRoleService;
use Illuminate\Console\Command;

class UpdateUserRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user roles based on subscription status';

    /**
     * Execute the console command.
     */
    public function handle(SubscriptionRoleService $subscriptionRoleService)
    {
        $this->info('Starting to update user roles based on subscription status...');

        $subscriptionRoleService->updateAllUserRoles();

        $this->info('User roles have been updated successfully!');

        return Command::SUCCESS;
    }
}
