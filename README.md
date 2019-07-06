# Running Laravel on AWS Elastic Beanstalk with HTTPS

The package provides the *essential* elements for a Laravel app running on AWS Elastic Beanstalk `(ELB)` with HTTPS.

It provides the following:

* Environment Configuration Files `.ebextensions` for Deployment 
  * Set the document root to `/public`
  * *Example* showing how to read environment configuration variables
  * Copy `.env.aws` to `.env`
  * Run `artisan` commands
  * *How to* install and run `npm` commands
* Middleware for HTTP to HTTPS redirection
  * *Includes the ability to configure exceptions to the HTTPS redirection*
* Middleware to recognize **secure** requests

## Elastic Beanstalk with HTTPS Quick Start Guide

Here are [Step-by-Step](GUIDE.md) instructions to deploy a *new* Laravel application to AWS Elastic Beanstalk.

## Installation

You can install this package using [composer](https://getcomposer.org/)
```sh
# With the Suggested Packages
composer require czproject/git-php ocramius/package-versions poing/laravel-elb

# Without the Suggested Packages
composer require poing/laravel-elb
```

#### Commands:
Once the package is installed, the following `artisan` commands will be available in your Laravel application:

* **`elb:install`**: Add `.ebextensions` directory and `.env.aws` to the Laravel application.
* **`elb:publish`**: Add `config/laravel-elb.php` to the Laravel application, to allow HTTPS redirection customization.
  * This will **disable** the *sample* `route` and `view` included with the package.
  
## Elastic Beanstalk Configuration Files

This package provides Elastic Beanstalk configuration files (.ebextensions) to configure the environment, customize AWS resources, and perform Laravel tasks.  *Like running `artisan` commands.*

```
.ebextensions/10-document-root.config
.ebextensions/20-app-key-test.config
.ebextensions/30-env-file.config
.ebextensions/40-artisan.config
.ebextensions/50-node-npm-gulp.config
```


## HTTP to HTTPS Redirection

Middleware included in this package *eliminates* the necessity of using `.ebextensions` to handle `HTTP` to `HTTPS` redirection with the Apache `RewriteEngine` method.  While allowing *some* traffic **not** to be redirected, *such as the Elastic Beanstalk HealthChecker*.

Redirection **does not** occur for ***any*** of the following conditions:

* The `User-Agent` is the Elastic Beanstalk HealthChecker
* The Application Environment `APP_ENV` is set to `local`
* The `URI` matches the `exclude` configuration settings

It provides the *same* functionality as the [`https-redirect`](https://github.com/awsdocs/elastic-beanstalk-samples/blob/master/configuration-files/aws-provided/security-configuration/https-redirect/php/https-redirect-php.config) recommended in the AWS [documentation](https://docs.aws.amazon.com/elasticbeanstalk/latest/dg/configuring-https-httpredirect.html), *and allows for custom paths to easily be excluded.*

> The middleware is a result of *frustration* trying to get the correct `RewriteCond` rules to **exclude** multiple conditions using the `.ebextensions` method.  Handling the `HTTP` to `HTTPS` redirection with Laravel provides more *flexibility* with less headaches.  *I was working with an application that could **not** fetch content from third party domains with HTTPS.*

* *This package **does not** prevent `HTTPS` access.*
* *It **does not** redirect `HTTPS` to `HTTP`.*
* *It **only** allows `HTTP` access to the specified `URI` paths.*

### Basic Usage

*By default*, this package includes a *sample* `view` and allows `HTTP` access to `URI`'s with a base of `/unsecure`.

```diff
// Green = HTTP Allowed, Red = Redirected to HTTPS
+ http://{domain.tld}/unsecure
+ http://{domain.tld}/unsecure/your/web/route
- https://{domain.tld}/
- https://{domain.tld}/other
```

#### Configuration

To use your own configuration, run `elb:publish` to install `config/laravel-elb.php` in your Laravel application.  

```
php artisan elb:publish
```

> This will **disable** the *sample* `view` included with the package.

##### Excluded URI Paths

* **`exclude`**: An array of `URI` paths that are **not** redirected to `HTTPS`.
  * **Empty array will redirect all `HTTP` to `HTTPS`.**

```
    'exclude' => [ 'alpha', 'bravo/charlie', ],
```
###### Behaviour:
```diff
// Green = HTTP Allowed, Red = Redirected to HTTPS
+ http://{domain.tld}/alpha
+ http://{domain.tld}/alpha/any/path
- https://{domain.tld}/bravo
+ http://{domain.tld}/bravo/charlie
+ http://{domain.tld}/bravo/charlie/any/path
- https://{domain.tld}/bravo/any
```

##### Strict Mode

* **`strict`**: Boolean setting that will limit the path to **only** those *specified* in the `exclude` setting.

```
    'exclude' => [ 'alpha', 'bravo/charlie', ],
    'strict' => true,
```
###### Behaviour:
```diff
// Green = HTTP Allowed, Red = Redirected to HTTPS
+ http://{domain.tld}/alpha
- https://{domain.tld}/alpha/any/path
- https://{domain.tld}/bravo
+ http://{domain.tld}/bravo/charlie
- https://{domain.tld}/bravo/charlie/any/path
- https://{domain.tld}/bravo/any
```

## Recognizing Secure Requests

The AWS Elastic Beanstalk environment uses a Load Balancer to serve `HTTPS` requests, while the Laravel application *actually* runs in an AWS Elastic Beanstalk environment that **only** supports `HTTP`.

This can cause the Laravel application to *represent* `HTTP` to helper methods that return `URL` information, since the Laravel application is **not aware** of the Load Balancer.

###### Incorrect Response:
```php
// https://domain.tld
url()->current(); // Returns: 'http://domain.tld'
```

This package uses [`peppeocchi/laravel-elb-middleware`](https://github.com/peppeocchi/laravel-elb-middleware) to *simplify* using `HTTPS` with your Laravel application on AWS Elastic Beanstalk.  Ensuring that your Laravel application will correctly recognize **secure** requests when running on Elastic Beanstalk with a Load Balancer.  *Allowing helper methods that return `URL` information, to represent the correct protocol `scheme`.*

###### Correct Response:
```php
// https://domain.tld
url()->current(); // Returns: 'https://domain.tld'
```

This middleware is *based* on a [gist](https://gist.github.com/peppeocchi/4f522663d7e88029daeba833c835df3d) by [Giuseppe Occhipinti](https://github.com/peppeocchi) that does the exact same thing.



