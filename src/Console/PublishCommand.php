<?php

namespace Laracube\Laracube\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laracube:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the Laracube resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'laracube-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'laracube-assets',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'laracube-views',
            '--force' => $this->option('force'),
        ]);

        $this->call('view:clear');
    }
}
