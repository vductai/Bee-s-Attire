<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Parent_Category;
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
        View::composer('layout.client.navigation', function ($parent){
            $selParentCategory = Parent_Category::limit(5)->get();
            $parent->with('parent', $selParentCategory);
        });

        View::composer('layout.client.footer', function ($categories){
            $cate = Category::limit(6)->get();
            $categories->with('Category', $cate);
        });

        View::composer('layout.client.testimonial', function ($comment) {
            $commentTop = Comment::limit(3)->get();
            $comment->with('comment', $commentTop);
        });

        View::composer('client.product.quickview-modal', function ($voucher) {
            $user = Auth::user();
            if (Auth::check()){
                $vouchers = $user->voucher;
            }else{
                $vouchers = collect();
            }
            $voucher->with('voucher', $vouchers);
        });

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