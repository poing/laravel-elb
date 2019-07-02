<?php

namespace Poing\Beanstalk;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
//use Poing\Beanstalk\Middleware\ElasticBeanstalkHttps;
//use Poing\Beanstalk\Middleware\HttpsProtocol;
use Illuminate\Routing\Router;

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
    //public function boot() {
    public function boot() {
    
        $router = $this->app['router'];
    
        //$router->aliasMiddleware('elb.redirect', HttpsProtocol::class);
        $router->aliasMiddleware('elb.https', Poing\Beanstalk\Middleware\ElasticBeanstalkHttps::class);

        //$kernel->prependMiddleware(HttpsProtocol::class);
        //$kernel->prependMiddleware(ElasticBeanstalkHttps::class); 

        //$this->app->middleware([ElasticBeanstalkHttps::class]);
        //$this->app->middleware([HttpsProtocol::class]);

//$this->app['router']->aliasMiddleware('elb-https', ElasticBeanstalkHttps::class);
//$this->app['router']->aliasMiddleware('elb-redirect', HttpsProtocol::class);

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
