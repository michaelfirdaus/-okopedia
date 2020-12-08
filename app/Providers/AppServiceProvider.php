<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Cart;
use App\User;

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
        view()->composer('*', function ($view)
        {
            $carts = Auth::user() != null ? Cart::where('user_id', Auth::user()->id)->get() : null;
            $user = Auth::user() != null ? User::where('id', Auth::user()->id)->first() : null;
            
            $view->with('carts', $carts)->with('user', $user);
        });
    }
}
