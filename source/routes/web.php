<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (in_array('unsecure', config('laravel-elb.exclude')))
{
    Route::get('/unsecure', function () {
        return view('unsecure::welcome');
    });
    Route::get('/', function () {
        return view('unsecure::welcome');
    });    
}