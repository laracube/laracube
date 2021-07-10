<?php

namespace Laracube\Laracube\Tests;

use Laracube\Laracube\Providers\LaracubePackageServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/Fixtures/Database/Migrations');

        $this->withFactories(__DIR__.'/Fixtures/Database/Factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaracubePackageServiceProvider::class,
            TestCaseServiceProvider::class,
        ];
    }
}
