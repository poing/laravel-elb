<?php

namespace Poing\Beanstalk;

//use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Poing\Beanstalk\Middleware\ElasticBeanstalkHttps;
use Poing\Beanstalk\Commands\BeanstalkInstall;

use Poing\Beanstalk\Middleware\HttpsProtocol;

class BeanstalkProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router) {
    
        // Add to middleware stack.
        $router->pushMiddlewareToGroup('web', ElasticBeanstalkHttps::class);
        $router->pushMiddlewareToGroup('web', HttpsProtocol::class);

        // Load Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                BeanstalkInstall::class,
            ]);
        }

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Default Package Configuration
        //$this->mergeConfigFrom(__DIR__.'/config/default.php', 'elb');
        //$this->mergeConfigFrom(__DIR__.'/config/elb.php', 'elb');

    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }


}
