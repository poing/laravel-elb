<?php

namespace Poing\Beanstalk;

//use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Poing\Beanstalk\Commands\BeanstalkInstall;
use Poing\Beanstalk\Commands\BeanstalkPublish;
use Poing\Beanstalk\Middleware\ElasticBeanstalkHttps;
use Poing\Beanstalk\Middleware\HttpsProtocol;
use Poing\Beanstalk\Providers\BeanstalkRouteServiceProvider as BeanstalkRoutes;

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

        // defaultStringLength for MariaDB or Auroa
        Schema::defaultStringLength(191);
    
        // Add to middleware stack.
        $router->pushMiddlewareToGroup('web', ElasticBeanstalkHttps::class);
        $router->pushMiddlewareToGroup('web', HttpsProtocol::class);

        // Load Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                BeanstalkInstall::class,
                BeanstalkPublish::class,
            ]);
        }

        // Publish Configuration Files
        $this->publishes(
            [ __DIR__ . '/config/laravel-elb.php' => config_path('laravel-elb.php'),
            ], 
            'laravel-elb-config'
        );

		// Add all routes
		$this->app->register(BeanstalkRoutes::class);
        
        // Load the views
        //$this->loadViews();
        $this->loadViewsFrom(__DIR__.'/Views', 'unsecure');


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Default Package Configuration
        $this->mergeConfigFrom(
            __DIR__ . '/config/default.php', 
            'laravel-elb'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-elb.php', 
            'laravel-elb'
        );

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


    /**
     * Load views
     *
     * @return void
     */
    private function loadViews() {

        $this->loadViewsFrom( __DIR__ . '/Views', 'elb');

    }

}
