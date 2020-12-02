<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Cart;

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
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            $view->with('carts', $carts);
        });
    }
}
