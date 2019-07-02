# Laravel Middleware for AWS Elastic Beanstalk HTTPS Support

This package provides middleware that will ensure that your Laravel app will correctly recognise **secure** requests when running on Elastic Beanstalk with a Load Balancer **-and-** middleware that will perform a `HTTPS` redirect for `HTTP` connections.  *Excluding the Elastic Beanstalk HealthChecker **and** user defined paths.*

There is *based* on a [gist](https://gist.github.com/peppeocchi/4f522663d7e88029daeba833c835df3d) that does the exact same thing.

## Installation
You can install this middleware through [Composer](https://getcomposer.org/)
```
composer require poing/laravel-elb
```

`psr-4` autoload *-and-* automatic registration of the `ServiceProvider` handle loading the middleware *automatically*.  *No additional steps are necessary.* 

## Usage

