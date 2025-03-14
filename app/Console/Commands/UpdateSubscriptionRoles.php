<?php

namespace App\Console\Commands;

use App\Services\SubscriptionRoleService;
use Illuminate\Console\Command;

class UpdateSubscriptionRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:update-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user roles based on subscription status';

    /**
     * The subscription role service instance.
     *
     * @var SubscriptionRoleService
     */
    protected $subscriptionRoleService;

    /**
     * Create a new command instance.
     *
     * @param SubscriptionRoleService $subscriptionRoleService
     * @return void
     */
    public function __construct(SubscriptionRoleService $subscriptionRoleService)
    {
        parent::__construct();
        $this->subscriptionRoleService = $subscriptionRoleService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Updating user roles based on subscription status...');

        try {
            $this->subscriptionRoleService->updateAllUserRoles();
            $this->info('User roles updated successfully.');
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to update user roles: ' . $e->getMessage());
            return 1;
        }
    }
}
