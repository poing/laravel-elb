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
    
        //$router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', ElasticBeanstalkHttps::class);
        $router->pushMiddlewareToGroup('web', HttpsProtocol::class);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Default Package Configuration
        //$this->mergeConfigFrom(__DIR__.'/config/default.php', 'wombat');
        //$this->mergeConfigFrom(__DIR__.'/config/wombat.php', 'wombat');

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
