<?php

namespace Poing\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;

/**
 * Put this file in app/Http/Middleware
 * Read more here https://github.com/peppeocchi/laravel-elb-middleware
 *
 */

class ElasticBeanstalkHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->setTrustedProxies(
            ['127.0.0.1', $request->server->get('REMOTE_ADDR')],
            Request::HEADER_X_FORWARDED_AWS_ELB
        );
        return $next($request);
    }
}
