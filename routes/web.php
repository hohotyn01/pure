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
    Route::get('/', 'Index@home')->name('home');
    Route::post('/', 'Index@homePost');

    Route::group(['middleware' => ['redirectNoOrder']], function () {
        Route::get('/personal_info', 'Index@personalInfo')->name('info');
        Route::post('/personal_info', 'Index@personalInfoPost');

        Route::get('/your_home', 'Index@yourHome')->name('yourHome');
        Route::post('/your_home', 'Index@yourHomePost');
        Route::post('/your_home_photo', 'Index@yourHomePostPhoto');

        Route::get('/materials', 'Index@materials')->name('materials');
        Route::post('/materials', 'Index@materialsPost');

        Route::get('/extras', 'Index@extras')->name('extras');
        Route::post('/extras', 'Index@extrasPost');

        Route::post('/extrasCalculate', 'CalculateExtras@calculate')->name('calculate');

        Route::get('/extras/charge', 'Payment@getPayment')->name('payment');
        Route::post('/extras/charge', 'Payment@postPayment')->name('payment');
    });

