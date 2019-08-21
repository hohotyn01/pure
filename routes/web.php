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

    Route::get('/', 'Home@index');
    Route::post('/', 'Home@index');

    Route::get('/personal_info', 'PersonalInfo@index')->name('info');
    Route::post('/personal_info', 'PersonalInfo@index');

    Route::get('/your_home', 'YourHome@index')->name('home');
    Route::post('/your_home', 'YourHome@index');

    Route::get('/materials', 'Materials@index')->name('materials');
    Route::post('/materials', 'Materials@index');

    Route::get('/extras', 'Extras@index')->name('extras');
    Route::post('/extras', 'Extras@index');