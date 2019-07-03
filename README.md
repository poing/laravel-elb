# Laravel Middleware for AWS Elastic Beanstalk HTTPS Support

This package provides middleware that *simplifies* using `HTTPS` with your Laravel app on AWS Elastic Beanstalk.

It provides middleware that will ensure that your Laravel app will correctly recognize **secure** requests when running on Elastic Beanstalk with a Load Balancer **-and-** middleware to perform `HTTP` to `HTTPS` redirection.

Recognizing **secure** requests is *based* on the [gist](https://gist.github.com/peppeocchi/4f522663d7e88029daeba833c835df3d) that does the exact same thing.

This package *eliminates* the necessity of using `.ebextensions` to handle `HTTP` to `HTTPS` redirection with the Apache `RewriteEngine` method.  While allowing *some* traffic **not** to be redirected, *such as the Elastic Beanstalk HealthChecker*.

> This package is the result of *frustration* from trying to get the correct `RewriteCond` rules to **exclude** multiple conditions using the `.ebextensions` method.  Handling the `HTTP` to `HTTPS` redirection with Laravel provides more *flexibility* with less headaches.

## Installation
You can install this package using [Composer](https://getcomposer.org/)
```
composer require poing/laravel-elb
```

`psr-4` autoload *-and-* automatic registration of the `ServiceProvider` handle loading the middleware *automatically*.  

*No additional steps are necessary.  **Except** on the [Elastic Beanstalk Load Balancer](http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/configuring-https-elb.html) side.* 

## Usage

`HTTPS` redirection will be *disabled* when the Laravel `APP_ENV` is set to `local`.

```
APP_ENV=local  // HTTPS Redirection Disabled
```

## Configuration

## .ebextensions

**YOU MUST USE GIT FOR `eb deply` TO WORK PROPERLY!**

