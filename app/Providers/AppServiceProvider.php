<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Notifications;
use App\Models\Notify_manager;
use App\Models\Parent_Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Product_featured_category;
use App\Models\Size;
use App\Models\User;
use App\Models\user_voucher;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
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
        // admin
        View::composer('layout.admin.notify-slider', function ($noti){
            $notis = Notify_manager::orderBy('created_at', 'desc')->get();
            $chats = Chat::whereHas('receiver.role', function ($query){
                $query->where('role_name', 'admin');
            })
                ->orderBy('created_at', 'desc')
                ->get();
            $noti->with(compact('chats', 'notis'));
        });

        View::composer('modal.update-variant', function ($get){
            $color = Color::all();
            $size = Size::all();
            $get->with(compact('size', 'color'));
        });
        /*---------------------------------------------------------------------------------------------------*/
        View::composer('client.product.popular-product', function ($popular){
            /*
             * $populars = Product::whereHas('featuredCategories', function ($query) {
                $query->where('product_featured_category.featured_categories_id', 1); // Chỉ định rõ bảng trung gian
            })
                ->with('featuredCategories') // Load danh mục liên quan
                ->take(8)*/
            $populars = Product::orderByDesc('created_at')
                ->limit(7)
                ->get();
            $popular->with(compact('populars'));
        });

        View::composer('layout.client.header', function ($count) {
            if (Auth::check()){
                $counts = Notifications::where('user_id', Auth::user()->user_id)
                    ->where('is_read', 'Chưa đọc')->count();
            }else{
                $counts = collect();
            }
            $count->with('counts', $counts);

        });

        View::composer('layout.client.header', function ($notifycation) {
            if (Auth::check()){
                $notifications = Notifications::where('user_id', Auth::user()->user_id)
                    ->where('is_read', 'Chưa đọc')
                    ->orderBy('created_at', 'desc')
                    ->limit(6)
                    ->get();
            }else{
                $notifications = collect();
            }
            $notifycation->with('noti', $notifications);
        });


        Carbon::setLocale('vi');
        Paginator::useBootstrapFive();
        View::composer('layout.client.navigation', function ($parent){
            $selParentCategory = Parent_Category::limit(5)->get();
            $parent->with('parent', $selParentCategory);
        });

        View::composer('layout.client.mobile-menu', function ($parent){
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

        View::composer('layout.client.post-new', function ($postNew) {
            $posts = Post::limit(4)->get();
            $postNew->with('posts', $posts);
        });

        View::composer('client.us.about', function ($about) {
            $user = User::count();
            $product = Product::count();
            $about->with(compact('user', 'product'));
        });

        View::composer('client.product.quickview-modal', function ($voucher) {
            $user = Auth::user();
            if (Auth::check()){
                $vouchers = user_voucher::where('user_id', $user->user_id)->get();
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
