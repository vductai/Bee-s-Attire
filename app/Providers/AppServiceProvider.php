<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*View::composer('client.carts.cart-slider', function ($view) {
            $user = auth()->user();
            $getCartSlider = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
            $view->with('getCartSlider', $getCartSlider);
        });*/
    }
}
