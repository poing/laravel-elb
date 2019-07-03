<?php

namespace Poing\Beanstalk\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

class BeanstalkInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elb:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Configuration Files (.ebextensions)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Publishing Beanstalk Configuration...');
        //$this->callSilent('vendor:publish', ['--tag' => 'laravel-elb-config']);
        $file = new Filesystem();
        $this->info('Creating .ebextensions directory.');
        $file->copyDirectory(
            __DIR__ . '/../.ebextensions',
            base_path('.ebextensions')
        );
        $this->info('Adding .env.aws environment file.');
        $file->copy(
            __DIR__ . '/../.env.aws',
            base_path('.env.aws')
        );
        $this->info('AWS Elastic Beanstalk installed successfully.');

    }
}
