<?php

namespace App\Providers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        Carbon::setLocale('vi');
        View::composer('client.carts.cart-slider', function ($view) {
            $user = Auth::user();
            if (Auth::check()){
                $getCartSlider = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
            }else{
                // gắn mảng rổng khi chưa login
                $getCartSlider = collect();
            }
            $view->with('getCartSlider', $getCartSlider);
        });

    }
}
