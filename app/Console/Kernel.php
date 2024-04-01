<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     // $schedule->command('inspire')->hourly();
    // }
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('app:calculate_total_salary')->dailyAt('09:30')->timezone('Asia/Yangon');
        $schedule->command('app:calculate_total_salary')->monthlyOn(1, '00:00')->timezone('Asia/Yangon');
            // $schedule->command('app:calculate_total_salary')
            //     ->monthlyOn(now()->endOfMonth()->day, '00:00')
            //     ->timezone('Asia/Yangon');

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
