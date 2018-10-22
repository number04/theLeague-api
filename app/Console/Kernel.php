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
        Commands\injury::class,
        Commands\day::class,
        Commands\waivers::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('theleague:stats-matchup')->hourly();

        $schedule->command('theleague:stats-year')->hourly();

        $schedule->command('theleague:injury')->hourly();

        $schedule->command('theleague:waivers')->timezone('Pacific/Auckland')->at('22:00');

        $schedule->command('theleague:day')->timezone('Pacific/Auckland')->at('22:00');
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
