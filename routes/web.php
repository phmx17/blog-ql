<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{any?}', function () {   // add dynamic route in {}; needed because laravel catches path before vue router, which will not work without using the stupid # hash mode 
    return view('welcome');
})->where('any', '^(?!graphql)[\/\w\.-]*'); // regex: any path containing 'graphql' will get caught by laravel; anything else will continue on to vue router;
