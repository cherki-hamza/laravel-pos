<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
*   Author: cherki hamza
*   dashborad routes
*/  //->name('dashboard.')


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth' ]
    ], function(){

    Route::prefix('dashboard')->middleware(['auth'])->group(function(){


        // route for main home dashboard
         Route::get('/' , 'Dashboard\DashboardController@index')->name('main');

        // route for users
         Route::resource('/users', 'Dashboard\UserController')->except(['show']);

          // route for categories
          Route::resource('/categories', 'Dashboard\CategoryController');

          // route for products
          Route::resource('/products', 'Dashboard\ProductController');


   });
});
