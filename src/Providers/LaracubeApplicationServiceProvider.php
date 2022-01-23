<?php

namespace Laracube\Laracube\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laracube\Laracube\Base\Filter;
use Laracube\Laracube\Base\Report;
use Laracube\Laracube\Base\Resource;
use Laracube\Laracube\Laracube;

class LaracubeApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     *
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->authorization();

        Laracube::registerItems(Laracube::$reports, app_path('Laracube/Reports'), Report::class);
        Laracube::registerItems(Laracube::$resources, app_path('Laracube/Resources'), Resource::class);
        Laracube::registerItems(Laracube::$filters, app_path('Laracube/Filters'), Filter::class);
    }

    /**
     * Configure the Laracube authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Laracube::auth(function ($request) {
            return Gate::check('viewLaracube', [$request->user()]);
        });
    }

    /**
     * Register the Laracube gate.
     *
     * This gate determines who can access Laracube in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewLaracube', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
