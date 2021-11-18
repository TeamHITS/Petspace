<?php

namespace App\Console;

use App\Jobs\GetGoogleReviews;
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
        Commands\OrderReminders::class,
        Commands\UnassignedOrder::class,
        Commands\DelayOrder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new GetGoogleReviews)->twiceMonthly(1, 16, '13:00');
        $schedule->command('technician:order-reminder')->everyFiveMinutes();
        $schedule->command('vendor:order-unassigned')->everyTenMinutes();
        $schedule->command('delay:order')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
