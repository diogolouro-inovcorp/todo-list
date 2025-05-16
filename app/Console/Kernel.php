<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\DailyTaskMail::class,
        \App\Console\Commands\NotifyExpiringTasks::class,
    ];
//    protected function schedule(Schedule $schedule): void
//    {
//        //Agenda o envio diário dos emails
////        $schedule->command('app:daily-task-mail')->everyMinute();
//
//    }
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:daily-task-mail')->dailyAt('08:00');
        $schedule->command('app:notify-expiring')->dailyAt('08:00');
    }


    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
