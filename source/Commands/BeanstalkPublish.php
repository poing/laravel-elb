<?php

namespace Poing\Beanstalk\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class BeanstalkPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elb:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Configuration Files to customize Laravel-ELB';

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
        $this->callSilent('vendor:publish', ['--tag' => 'laravel-elb-config']);
        $this->info('<fg=blue>config/laravel-elb.php</> <fg=green>successfully installed.</>');

    }
}
