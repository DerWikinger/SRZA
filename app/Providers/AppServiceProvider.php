<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //variant 1
//        view()->share('users', User::all());

        //variant 2
//        view()->composer(['users.index'], function ($view) {
//           $view->with('users', User::all());
//        });
    }
}
