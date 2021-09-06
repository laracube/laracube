<?php

namespace Laracube\Laracube\Tests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laracube\Laracube\Laracube;
use Laracube\Laracube\Tests\Fixtures\Laracube\Filters\CannotSeeUserFilter;
use Laracube\Laracube\Tests\Fixtures\Laracube\Filters\UserFilter;
use Laracube\Laracube\Tests\Fixtures\Laracube\Reports\CannotSeeUserReport;
use Laracube\Laracube\Tests\Fixtures\Laracube\Reports\UserReportOne;
use Laracube\Laracube\Tests\Fixtures\Laracube\Reports\UserReportTwo;
use Laracube\Laracube\Tests\Fixtures\Laracube\Resources\CannotSeeResource;
use Laracube\Laracube\Tests\Fixtures\Laracube\Resources\Card;
use Laracube\Laracube\Tests\Fixtures\Laracube\Resources\PaginatedTable;
use Laracube\Laracube\Tests\Fixtures\Laracube\Resources\SimpleTable;

class TestCaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->authorization();

        Laracube::pushItems(Laracube::$reports, [
            UserReportOne::class,
            UserReportTwo::class,
            CannotSeeUserReport::class,
        ]);

        Laracube::pushItems(Laracube::$resources, [
            PaginatedTable::class,
            SimpleTable::class,
            Card::class,
            CannotSeeResource::class,
        ]);

        Laracube::pushItems(Laracube::$filters, [
            UserFilter::class,
            CannotSeeUserFilter::class,
        ]);
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
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
