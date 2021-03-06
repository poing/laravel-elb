# Elastic Beanstalk with HTTPS Quick Start Guide

> This document assumes you have a **working** Elastic Beanstalk environment that supports `HTTPS`. *Tested using the Sample application.*  And that the `aws cli` is installed in your development environment.
>
> A working setup *typically* includes a domain, `CNAME` record, [certificate](https://console.aws.amazon.com/acm/), [ELB environment](https://console.aws.amazon.com/elasticbeanstalk/), `HTTPS` listener [configured](ELB.md), and the *appropiate* ELB/RDS [security group](https://console.aws.amazon.com/ec2/v2/#SecurityGroups) rules.

### Step-by-Step

#### 1. Create your Laravel Application

```sh
composer create-project --prefer-dist laravel/laravel my-project
cd my-project

```

#### 2. Install `poing/laravel-elb` and the *suggested* packages

```sh
composer require czproject/git-php ocramius/package-versions poing/laravel-elb
```

#### 3. Install the *Essential* Elements to Support Elastic Beanstalk

```sh
php artisan elb:install
```

#### 4. Customize Deployment for Your Laravel Application - *optional*

Modify `.env.aws` and `.ebextensions` files **as needed**.

#### 5. Version Control

**YOU MUST USE VERSION CONTROL FOR `eb deply` TO WORK PROPERLY!**

The `eb cli` will **not** properly deploy *all* files, without version control.  

```sh
git init
git add .
git commit -am "Initial Commit"
```

#### 6. Initialize Elastic Beanstalk with `eb cli`

```sh
eb init
```

#### 7. Environment Settings - *optional*

Environment settings that are **not** stored in `.env.aws` *may* be configured with `eb setenv` or using the [ELB console](https://console.aws.amazon.com/elasticbeanstalk/).

```sh
eb setenv APP_KEY= APP_NAME= DB_HOST= DB_DATABASE= DB_USERNAME= DB_PASSWORD=
```

#### 8. Deploy to Elastic Beanstalk

```sh
eb deploy
```

#### 9. Visit Site

Open your site in a browser.

The sample view, *included with the package*, demonstrates `HTTP` to `HTTPS` redirection and *exceptions*.

#### 10. Publish `config/laravel-elb.php` to Your Laravel Application

To **disable** the sample view, run `elb:publish` and modify the configuration for your Laravel application.

```sh
php artisan elb:publish
git add config/laravel-elb.php
git commit -am "Disable sample view"
eb deploy
```

#### 11. Create, Commit, and Deploy

```sh
git add {any new files}
git commit -am "Changes to Your Application"
eb deploy
```