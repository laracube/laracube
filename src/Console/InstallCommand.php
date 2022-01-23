<?php

namespace Laracube\Laracube\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laracube:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the laracube resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Laracube Service Provider...');
        $this->call('vendor:publish', ['--tag' => 'laracube-provider']);

        $this->comment('Publishing Laracube Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'laracube-assets']);

        $this->comment('Publishing Laracube Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'laracube-config']);

        $this->comment('Publishing Laracube Views...');
        $this->callSilent('vendor:publish', ['--tag' => 'laracube-views']);

        $this->registerLaracubeServiceProvider();

        $this->copyFilesFromStub();

        $this->info('Laracube scaffolding installed successfully.');
    }

    /**
     * Register the Laracube service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerLaracubeServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\LaracubeServiceProvider::class')) {
            return;
        }

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL,
            "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL."        {$namespace}\Providers\LaracubeServiceProvider::class,".PHP_EOL,
            $appConfig
        ));

        file_put_contents(app_path('Providers/LaracubeServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/LaracubeServiceProvider.php'))
        ));

        $this->setAppNamespaceOn(app_path('Providers/LaracubeServiceProvider.php'));
    }

    /**
     * Copy required files.
     */
    protected function copyFilesFromStub()
    {
        $directories = [
            app_path('Laracube'),
            app_path('Laracube/Collections'),
            app_path('Laracube/Resources'),
            app_path('Laracube/Reports'),
        ];

        foreach ($directories as $directory) {
            $this->createDirectory($directory);
        }

        $files = [
            __DIR__.'/../Stubs/Collections/UserCollection.stub' => app_path('Laracube/Collections/UserCollection.php'),
            __DIR__.'/../Stubs/Resources/UserTable.stub' => app_path('Laracube/Resources/UserTable.php'),
            __DIR__.'/../Stubs/Reports/UserReport.stub' => app_path('Laracube/Reports/UserReport.php'),
        ];

        foreach ($files as $from => $to) {
            copy($from, $to);
        }
    }

    /**
     * Create directory if not exits.
     *
     * @param $path
     */
    protected function createDirectory($path)
    {
        if (! File::isDirectory($path)) {
            mkdir($path);
        }
    }

    /**
     * Set the namespace on the given file.
     *
     * @param  string  $file
     * @return void
     */
    protected function setAppNamespaceOn($file)
    {
        file_put_contents($file, str_replace(
            'App\\',
            $this->laravel->getNamespace(),
            file_get_contents($file)
        ));
    }
}
