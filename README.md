# Running Laravel on AWS Elastic Beanstalk with HTTPS

The package provides the *essential* elements for a Laravel app running on AWS Elastic Beanstalk `(ELB)` with HTTPS.

It provides the following:

* Middleware to recognize **secure** requests
* Middleware for HTTP to HTTPS redirection
  * *Includes the ability to configure exceptions to the HTTPS redirection*
* Environment Configuration Files `.ebextensions` for Deployment 
  * Set the document root to `/public`
  * *Example* showing how to read environment configuration variables
  * Copy `.env.aws` to `.env`
  * Run `artisan` commands
  * *How to* install and run `npm` commands

## Installation

You can install this package using [composer](https://getcomposer.org/)
```sh
composer require poing/laravel-elb
```

#### `artisan` Commands
Once the package is installed, the following `artisan` commands will be available in your Laravel application:

* **`elb:install`**: Add `.ebextensions` directory and `.env.aws` example.
* **`elb:publish`**: Puts `config/laravel-elb` into the Laravel application, to allow HTTPS redirection customization.

## HTTP to HTTPS Redirection

Middleware included in this package *eliminates* the necessity of using `.ebextensions` to handle `HTTP` to `HTTPS` redirection with the Apache `RewriteEngine` method.  While allowing *some* traffic **not** to be redirected, *such as the Elastic Beanstalk HealthChecker*.

> The middleware is a result of *frustration* from trying to get the correct `RewriteCond` rules to **exclude** multiple conditions using the `.ebextensions` method.  Handling the `HTTP` to `HTTPS` redirection with Laravel provides more *flexibility* with less headaches.  *I was working with an application that could **not** fetch content from third party domains that use HTTPS.*

*This package does **not** prevent or redirect `HTTPS` to `HTTP`.  It just allows `HTTP` access to specific `URI`'s.*

### Basic Usage

*By default*, this package includes a *sample* `view` and allows `HTTP` access to `URI`'s with a base of `/unsecure`.

http://{domain.tld}/unsecure






---
---



### Starting from Scratch

```sh
composer create-project --prefer-dist laravel/laravel my-project
cd my-project
composer require poing/laravel-elb
php artisan elb:install
php artisan elb:publish; # optional

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

