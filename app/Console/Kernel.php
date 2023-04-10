<?php

namespace App\Console;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Leave;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\FeesTableBacku::class, //for fees table backup
        \App\Console\Commands\LeadCommand::class,
        \App\Console\Commands\StatusChange::class,
        \App\Console\Commands\LeadAssign::class,
        
        \App\Console\Commands\AssignData::class,
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
	
// 	 $schedule->command('work:monthly')
//               ->everyFiveMinutes();dailyAt('20:00')everyThirtyMinutes  ->everyThirtyMinutes();


     $schedule->command('Fees:Table')->hourly(); //for fees table backup  everyFiveMinutes();
      $schedule->command('Lead')->everyMinute(); //delete
     $schedule->command('status:change')->everyFiveMinutes();
	//$schedule->command('Lead:Assign')->everyMinute();
	
 	//$schedule->command('Assign:Data')->everyMinute();

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
