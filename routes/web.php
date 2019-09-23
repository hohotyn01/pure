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
    Route::get('/', 'Index@home')->name('index');
    Route::post('/', 'Index@homePost');

//    Route::resource('/fake', 'FakeController');
    
    Route::group(['middleware' => ['redirectUserId']], function () {

        Route::get('/personal_info', 'Index@personalInfo')->name('info');
        Route::post('/personal_info', 'Index@personalInfoPost');


        Route::group(['middleware' => ['redirectPersonalInfo']], function () {

            Route::get('/your_home', 'Index@yourHome')->name('home');
            Route::post('/your_home', 'Index@yourHomePost');
            Route::post('/your_home_photo', 'Index@yourHomePostPhoto');


            Route::group(['middleware' => ['redirectYourHome']], function () {

                Route::get('/materials', 'Index@materials')->name('materials');
                Route::post('/materials', 'Index@materialsPost');

                Route::get('/extras', 'Index@extras')->name('extras')->middleware('redirectMaterials');
                Route::post('/extras', 'Index@extrasPost')->middleware('redirectMaterials');

                Route::post('/extrasCalculate', 'CalculateExtras@calculate')->name('calculate');

            });

        });

    });

