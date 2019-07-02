<?php

namespace Poing\Beanstalk;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Poing\Middleware\ElasticBeanstalkHttps;
use Poing\Middleware\HttpsProtocol;

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
    public function boot() {

        //$this->app->middleware([ElasticBeanstalkHttps::class]);
        //$this->app->middleware([HttpsProtocol::class]);

$this->app['router']->aliasMiddleware('elb-https', ElasticBeanstalkHttps::class);
$this->app['router']->aliasMiddleware('elb-redirect', HttpsProtocol::class);
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
