<?php

namespace App\Console;

use App\Jobs\ProcessTaskJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info('Обработка запущена!!!');
            dispatch(new ProcessTaskJob());
        })->everyMinute();
        $schedule->exec('touch /var/www/test_schedule.txt')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
