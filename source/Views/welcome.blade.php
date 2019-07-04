<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .version {
                color: #636b6f;
                padding: 0 25px;
                font-size: 10px;
                font-weight: 600;
                letter-spacing: .2rem;
                text-decoration: none;
                text-transform: uppercase;

            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ env('APP_NAME') }}
                </div>

<?php

    // AWS EB Enviroment Variable -or- Local Git Branch
    if (env('GIT_VERSION')) {
        $git_version = env('GIT_VERSION');
    } else {
        // AWS EB doesn't retain repository information
        if (class_exists('Cz\Git\GitRepository')) {
            try {
                $repo = new Cz\Git\GitRepository(base_path());
                $git_version = $repo->getCurrentBranchName();
            } catch (Exception $e) {
                $git_version = $e->getMessage();
            }
        } else {
            $git_version = 'Unable to Access';
        }
    }

    // Package Version for poing/laravel-elb
    if (class_exists('PackageVersions\Versions')) {
        $elb = 'poing/laravel-elb';
        try {
            $package = PackageVersions\Versions::getVersion($elb);
            $package_version = strtok($package,'@');
        } catch (Exception $e) {
            $package_version = $e->getMessage();
        }
    } else {
        $package_version = 'Unable to Access';
    }
    
    $base_url = parse_url(url()->current());
    $base_url['scheme'] = ($base_url['scheme'] == 'http') ? 'https' : 'http';
    $url = $base_url['scheme'] . '://' . $base_url['host'] . $base_url['path'];

?>


                <div class="links m-b-md">
                    <a href={{ $url }}>Try: {{ $base_url['scheme'] }}</a>
                </div>

                <div class="links m-b-md">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
                <div class="version">
                    {{ url('/') }}
                </div>
                <div class="version">
                    Laravel Version: {{ app()->version() }}
                </div>
                <div class="version">
                    Git Branch: {{ $git_version }}
                </div>
                <div class="version">
                   {{ App::environment() }}
                </dir>
                <div class="version">
                 poing/laravel-elb: {{ $package_version }}
                  </div>

            </div>
        </div>
    </body>
</html>
