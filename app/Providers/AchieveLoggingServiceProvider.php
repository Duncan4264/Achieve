<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Utility\AchieveLogger;
use App\Services\Utility\AchievementLogger;


class AchieveLoggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Utility\AchieveLoggerService', function ($app) {
            return new AchievementLogger();
        });
    }
    /*
     * Method that provides the Logger service
    */
    public function provides()
    {
        AchieveLogger::info("Deferred true and I am here in provides()");
        return['App\Services\Utility\AchieveLoggerService'];
    }
}
