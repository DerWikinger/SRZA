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
        $this->app->bind(\App\Models\User::class, function ($app) {
           return new User([
               'name' => 'New User',
               'login' => 'newuser',
               'password' => '',
               'email' => 'new@user.com'
           ]);
        });

        $this->app->bind('User', \App\Models\User::class);
        $this->app->bind('user', \App\Models\User::class);
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
