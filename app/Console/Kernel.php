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
        Commands\statsMatchup::class,
        Commands\statsYear::class,
        Commands\injury::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('theleague:stats-matchup')
            ->hourly()
            ->between('19:00', '00:00')
            ->timezone('America/Los_Angeles');

        $schedule->command('theleague:stats-year')
            ->hourly()
            ->between('19:00', '00:00')
            ->timezone('America/Los_Angeles');

        $schedule->command('theleague:injury')
            ->daily()
            ->timezone('America/Los_Angeles');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
