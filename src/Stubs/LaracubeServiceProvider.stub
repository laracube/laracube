<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laracube\Laracube\Providers\LaracubeApplicationServiceProvider;

class LaracubeServiceProvider extends LaracubeApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the laracube gate.
     *
     * This gate determines who can access laracube in non-local environments.
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
}
