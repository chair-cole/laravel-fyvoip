<?php

namespace Mumutou\LaravelFYVoip;

use Mumutou\FYVoip\FYAPI;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/config.php' => config_path('feiyu.php'),
            ], 'config');
        }   
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'feiyu'
        );  

        $this->app->singleton(['feiyu'], function($app){
            return new FYAPI(config('feiyu'));
        }); 
    }
}
