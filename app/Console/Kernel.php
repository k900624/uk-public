<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\sendReInvite'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        // the call method
        // $schedule->call(function () {
        //     $users = DB::table('users')
        //         ->where('invited_at' > Carbon::now()->subDays(3))
        //         ->where('last_login_at', null)
        //         ->get();
            
        //     foreach($users as $user) {
        //         // send notify
        //     }
        // // })->cron('0 0 */3 * *');
        // })->daily();
        $schedule->command('notify:reinvite')->daily(); // Отправка напоминания на email через 3 дня

        // exec method
        // backup database
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');

        $schedule->exec("mysqldump -h {$host} -u {$username} -p{$password} {$database}")
            ->daily()
            ->sendOutputTo('/backups/daily_backup.sql');
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
