# Elastic Beanstalk with HTTPS Quick Start Guide

> This document assumes you have an **working** Elastic Beanstalk environment that supports `HTTPS`.  *Tested using the Sample application.*
>
> A working setup *typically* includes a domain, `CNAME` record, [certificate](https://console.aws.amazon.com/acm/), [ELB environment](https://console.aws.amazon.com/elasticbeanstalk/), `HTTPS` listener [configured](ELB.md), and the *appropiate* ELB/RDS [security group](https://console.aws.amazon.com/ec2/v2/#SecurityGroups) rules.

### Starting from Scratch

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

#### 4. Customize Your Laravel Application - *optional*

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