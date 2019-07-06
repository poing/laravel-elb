# Elastic Beanstalk with HTTPS Quick Start Guide

> This document assumes you have an **working** Elastic Beanstalk environment that supports `HTTPS`.  *Tested using the Sample application.*
>
> A working setup *typically* includes a domain, `CNAME` record, [certificate](https://console.aws.amazon.com/acm/), [ELB environment](https://console.aws.amazon.com/elasticbeanstalk/), `HTTPS` listener [configured](ELB.md), and the *appropiate* ELB/RDS [security group](https://console.aws.amazon.com/ec2/v2/#SecurityGroups) rules.

### Starting from Scratch

1. Create your Laravel Application

```sh
composer create-project --prefer-dist laravel/laravel my-project
cd my-project

```

2. Install `poing/laravel-elb` and the *suggested* packages

```sh
composer require czproject/git-php ocramius/package-versions poing/laravel-elb
```

3. Install the essential elements to support deployment to Elastic Beanstalk

```sh
php artisan elb:install
```

4. Customize Laravel the Application - *optional*

Modify `.env.aws` and `.ebextensions` files *as needed*.

5. Version Control

**YOU MUST USE VERSION CONTROL FOR `eb deply` TO WORK PROPERLY!**

The `eb cli` will **not** properly deploy *all* files, without version control.

```sh
git init
git add .
git commit -am "Initial Commit"
```

6. 


```sh
eb init
eb use elb-environment
eb setenv APP_KEY= APP_NAME= DB_HOST= DB_DATABASE= DB_USERNAME= DB_PASSWORD=
eb deploy
```

`psr-4` autoload *-and-* automatic registration of the `ServiceProvider` handles loading the middleware *automatically*.  

*No additional steps are necessary.  **Except** on the [Elastic Beanstalk Load Balancer](http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/configuring-https-elb.html) side.* 

---





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