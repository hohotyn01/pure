<?php

namespace App\Providers;

use Session;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class UserOrderServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->when('App\Http\Controllers\Index')
            ->needs('$orderModel')
            ->give(function () {
                return (
                    Session::has('userId')
                        ? $this->userService->find(Session::get('userId'))
                        : null
                );
            });*/
    }

    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
