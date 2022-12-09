<?php

namespace App\Console;

use App\Console\Commands\sendNotiUser;
use Carbon\Carbon;
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
        //
        sendNotiUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $seconds = 5;
        // $schedule->call(function () use ($seconds){
        //     $dt = Carbon::now();
        //     $x = 60 / $seconds;
        //     do {
        //         sendNotiUser::
        //     } while ($x --> 1);
        // })->everyMinute();
        // $schedule->command('noti:sendAlter')->everySe
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

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule)
    {
        // this command will run every 5 seconds
        $shortSchedule->command('noti:send')->everySeconds(5);
 
        // this command will run every second and its signature will be retrieved from command automatically
        // $shortSchedule->command(\Spatie\ShortSchedule\Tests\Unit\TestCommand::class)->everyMinuate();
    }
}
