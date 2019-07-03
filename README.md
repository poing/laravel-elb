# Running Laravel on AWS Elastic Beanstalk with HTTPS

The package proveds the necessary *essentials* to get your Laravel app running on AWS Elastic Beanstalk `(ELB)` with HTTPS.

It provides the following:

* Middleware to recognize **secure** requests
* Middleware for HTTP to HTTPS redirection
* Environment Configuration Files `.ebextensions` for Deployment 

---

## Installation

You can install this package using [Composer](https://getcomposer.org/)
```
composer require poing/laravel-elb
```

### Starting from Scratch

```
composer create-project --prefer-dist laravel/laravel my-project
cd project
composer require poing/laravel-elb
php artisan elb:install

git init
git add .
git commit -am "Initial Commit"

eb init
eb use elb-environment
eb setenv APP_KEY= APP_NAME= DB_HOST= DB_DATABASE= DB_USERNAME= DB_PASSWORD=
eb deploy
```

`psr-4` autoload *-and-* automatic registration of the `ServiceProvider` handles loading the middleware *automatically*.  

*No additional steps are necessary.  **Except** on the [Elastic Beanstalk Load Balancer](http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/configuring-https-elb.html) side.* 

---

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

