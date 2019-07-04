<?php

namespace Poing\Beanstalk\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol {

    /**
     * HTTPS Redirect with Exceptions
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if (
                !$request->secure() &&
                !(App::environment() === 'local') &&
                !(
//                  ($request->is('unsecure') || $request->is('unsecure/*')) ||
                    ($this->unsecureConfig($request)) ||
                    ($request->header('User-Agent') === 'ELB-HealthChecker/2.0')
                )
            ) {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request);
    }

    /**
     * Check for ELB-HealthChecker User Agent
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function elbHealthChecker($request)
    {
        $agent = $request->header('User-Agent');
        $check = 'ELB-HealthChecker';

        return (strpos($agent, $check) == 0) ? 'true' : 'false';
    }
    
    private function unsecureConfig($request)
    {

        if (empty(config('laravel-elb.exclude')))
            return false;
    
        foreach (config('laravel-elb.exclude') as $value)
        {
            if ($request->is($value))
                return true;

            if (!config('laravel-elb.strict'))
                if ($request->is($value . '/*'))
                    return true;
        }
        
        return false;
    
    }
}
