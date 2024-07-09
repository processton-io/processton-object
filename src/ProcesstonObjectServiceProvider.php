<?php

namespace Processton\ProcesstonObject;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProcesstonObjectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('module-object.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'module-object');

        // Register the main class to use with the facade
        $this->app->singleton('processton-object', function () {
            return new ProcesstonObject;
        });
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('module-object.base_path'),
            'middleware' => [
                ... (config('processton-client.middleware') ? config('processton-client.middleware') : []),
                ... (config('module-object.middleware') ? config('module-object.middleware') : [])
            ],
        ];
    }
}
