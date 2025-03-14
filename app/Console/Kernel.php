<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdateUserRolesCommand::class,
        Commands\UpdateSubscriptionRoles::class,
        Commands\TestSubscriptionRoles::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run daily to update user roles based on subscription status
        $schedule->command('users:update-roles')->daily();

        // Run daily to update user roles based on subscription status
        $schedule->command('subscription:update-roles')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
