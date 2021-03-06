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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('activitylog:clean')->daily(); //Clean older activity logs
        // $schedule->command('incevio:kpi')->dailyAt('23:58');
        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');
       // $schedule->command('backup:monitor')->daily()->at('03:00');

        // Generate sitemap daily basis
        $schedule->command('seo:generate-sitemap')->daily();

        if(config('app.demo') == true){
            $schedule->command('incevio:reset-demo')->twiceDaily(1, 13); //Reset the demo applcoation
        }
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
