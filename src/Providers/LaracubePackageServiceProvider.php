<?php

namespace Laracube\Laracube\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laracube\Laracube\Console\InstallCommand;

class LaracubePackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->offerPublishing();
        $this->registerCommands();
    }

    /**
     * Register the Laracube routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'domain' => config('laracube.domain', null),
            'prefix' => 'laracube-api',
            'namespace' => 'Laracube\Laracube\Http\Controllers',
            'middleware' => config('laracube.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        });

        Route::group([
            'domain' => config('laracube.domain', null),
            'prefix' => config('laracube.path', '/laracube'),
            'namespace' => 'Laracube\Laracube\Http\Controllers',
            'middleware' => config('laracube.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }

    /**
     * Register the Laracube resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'laracube');
    }

    /**
     * Setup the resource publishing groups for Laracube.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Stubs/LaracubeServiceProvider.stub' => app_path('Providers/LaracubeServiceProvider.php'),
            ], 'laracube-provider');

            $this->publishes([
                __DIR__.'/../../config/laracube.php' => config_path('laracube.php'),
            ], 'laracube-config');

            $this->publishes([
                __DIR__.'/../resources/views/partials' => resource_path('views/vendor/laracube/partials'),
            ], 'laracube-views');

            $this->publishes([
                LARACUBE_PATH.'/public' => public_path('vendor/laracube'),
            ], 'laracube-assets');
        }
    }

    /**
     * Register the Laracube Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if (! defined('LARACUBE_PATH')) {
            define('LARACUBE_PATH', realpath(__DIR__.'/../../'));
        }

        $this->mergeConfigFrom(__DIR__.'/../../config/laracube.php', 'laracube');
    }
}
