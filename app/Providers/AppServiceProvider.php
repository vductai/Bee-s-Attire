<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
    }

    public function boot(): void
    {

            view()->composer('*', function ($view) {
                $user = Auth::user();

                if ($user) {
                    $wishlistProducts = Wishlist::where('user_id', $user->user_id)->pluck('product_id')->toArray();
                } else {
                    $wishlistProducts = [];
                }
        
                $listAllProduct = Product::all(); 

                $view->with('wishlistProducts', $wishlistProducts)
                     ->with('listAllProduct', $listAllProduct);
            });
        
            View::composer('client.carts.cart-slider', function ($view) {
                $user = Auth::user();
                if ($user) {
                    $getCartSlider = Cart::where('user_id', $user->user_id)->with(['productVariant', 'product'])->get();
                } else {
                    $getCartSlider = collect();
                }
                $view->with('getCartSlider', $getCartSlider);
            });
        }
        
    
}
