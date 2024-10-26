<?php

namespace App\Providers;


use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share the total number of users with all views
        View::composer('*', function ($view) {
            $totalUsers = User::count(); // Count the total number of users
            $view->with('totalUsers', $totalUsers); // Share with the view
        });
    }
}
