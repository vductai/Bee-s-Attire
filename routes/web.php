<?php

use App\Http\Controllers\admin\CategoryAPIController;
use App\Http\Controllers\admin\CategoryParentController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ContactAdminController;
use App\Http\Controllers\admin\CouponUserController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SizeAPIController;
use App\Http\Controllers\admin\StatisticsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VoucherController;
use App\Http\Controllers\admin\VouchersAPIController;
use App\Http\Controllers\admin\OrderController as OrderAdmin;
use App\Http\Controllers\admin\PostController as PostAdmin;
use App\Http\Controllers\admin\NotifycationController as NotiAdmin;

use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthClientController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\auth\VerificationController;

use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\ChatController;
use App\Http\Controllers\client\CheckOutController;
use App\Http\Controllers\client\CheckPaymentMethodController;
use App\Http\Controllers\client\CommentController;
use App\Http\Controllers\client\MoMoController;
use App\Http\Controllers\client\NotificationController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\ParentProductController;
use App\Http\Controllers\client\PostController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\ProductController as ProductClient;
use App\Http\Controllers\client\SearchController;
use App\Http\Controllers\client\SupportController;
use App\Http\Controllers\client\VNPayController;
use App\Http\Controllers\client\WishListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => ['auth:sanctum', 'auth:web']], function () {
    // route admin và user dùng chung
    Route::group(['middleware' => ['checkRole:user,admin']], function () {
        Route::post('/logout', [AuthClientController::class, 'logoutClient']);
        // chat
        Route::post('/send-message', [ChatController::class, 'sendMessage']);
        Route::get('/get-chat/{senderId}', [ChatController::class, 'getChatUserAdmin']);
        Route::get('/get-chats/{senderId}', [ChatController::class, 'getChatUser']);
        // thong báo
        Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
        // check notifycation
        Route::get('/check-new-notifications', [NotificationController::class, 'checkNewNotifications']);
        // update noti
        Route::put('/noti/{id}', [NotificationController::class, 'updateStatusNoti']);
        //del noti
        Route::delete('/del-noti', [NotificationController::class, 'delAllNoti']);
        // get profile
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
        // update profile
        Route::put('/changePassword', [ProfileController::class, 'changePasswordProfile']);
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile-user');
        // wishlist
        Route::get('/wish-list', [WishListController::class, 'index'])->name('list-wish');
        Route::get('/wish-list/{id}', [WishListController::class, 'show'])->name('show-wish');
        // add whishlist
        Route::post('/whishlist', [WishListController::class, 'store'])->name('whishlist-store');
        // delete wichlist
        Route::delete('/whishlist/{id}', [WishListController::class, 'delete'])->name('whishlist-del');
        //crud comment
        Route::post('/comment', [CommentController::class, 'comment']);
        // add cart
        Route::post('/addCart', [CartController::class, 'addCart'])->name('addCart');
        // get cart
        Route::get('/shoping-cart', [CartController::class, 'getCart'])->name('viewCart');
        // Update cart
        Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update-cart');
        // delete cart
        Route::delete('/deleteCart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
        Route::delete('/deleteCartSlider/{id}', [CartController::class, 'deleteCartSlider'])->name('deleteCartSlider');
        // add voucher
        Route::get('/checkout', [CheckOutController::class, 'selectCart'])->name('checkout');
        Route::post('/addVoucher', [CheckOutController::class, 'applyVoucher'])->name('addVoucher');
        // online checkout

        Route::post('online-checkout', [CheckPaymentMethodController::class, 'onlineCheckOut'])->name('check-payment-method');
        // vnpay
        Route::get('/order-success', [CheckPaymentMethodController::class, 'handlePaymentReturn'])->name('vnpay-return');
        Route::view('error-order', 'client.message.orderSuccess')->name('success-checkout');
        // momo
        Route::get('/return-momo', [CheckPaymentMethodController::class, 'orderSuccessMono'])->name('momo-return');
        // get order
        Route::get('/order', [OrderController::class, 'getAllOrder'])->name('get-all-order');
        Route::get('/order-detail/{id}', [OrderController::class, 'orderDetail'])->name('detail-order');
        Route::get('/track-order', [OrderController::class, 'trackOrder'])->name('order-track');
        Route::post('/order/{id}/cancel', [OrderController::class, 'cancelOrder']);
        Route::post('/order/{id}/success', [OrderController::class, 'successOrder']);
        // get invoice
        Route::get('/order/{id}/invoice', [OrderController::class, 'printInvoice'])->name('invoice-print');
    });

    // route chỉ admin mới dùng được
    Route::group(['middleware' => ['checkRole:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [StatisticsController::class, 'statistics'])->name('dashboard');
            // voucher
            Route::get('/coupon-user', [CouponUserController::class, 'formAdd'])->name('add-form-coupon-user');
            Route::post('/coupon-user', [CouponUserController::class, 'store'])->name('add-coupon-user');
            Route::delete('/coupon-user/{id}', [CouponUserController::class, 'delete'])->name('delete-coupon');
            // crud categories
            Route::resource('categories', CategoryAPIController::class);
            // category parent
            Route::resource('category-parent', CategoryParentController::class);
            // crud role
            Route::resource('role', RolesController::class);
            // crud size
            Route::resource('size', SizeAPIController::class);
            // crud user
            Route::resource('user',  UserController::class);
            // crud voucher
            Route::resource('coupon', VouchersAPIController::class);
            // crud color
            Route::resource('color', ColorController::class);
            // crud product
            Route::resource('product', ProductController::class);
            // crud product variant
            Route::resource('product-variant', ProductVariantController::class);
            // dashboard
            //Route::get('/', [AuthAdminController::class, 'dashboard'])->name('dashboard');
            // action user, product, post
            Route::post('/actionUser/{id}', [AuthAdminController::class, 'toggleUserStatus'])->name('action-user');
            Route::post('/actionProduct/{id}', [AuthAdminController::class, 'toggleProductStatus'])->name('action-product');
            Route::post('/actionPost/{id}', [PostAdmin::class, 'togglePostStatus'])->name('action-post');
            // order
            Route::get('/order', [OrderAdmin::class, 'listOrder'])->name('admin-list-order');
            Route::get('/order/{id}/detail', [OrderAdmin::class, 'detailOrder'])->name('admin-order-detail');
            Route::get('/export-order', [OrderAdmin::class, 'export'])->name('export-order');
            // post
            Route::resource('post', PostAdmin::class);
            // contact
            Route::get('/message', [ContactAdminController::class, 'index'])->name('get-contact');
            Route::get('/message/{id}', [ContactAdminController::class, 'edit'])->name('get-contact-edit');
            Route::post('/rep', [ContactAdminController::class, 'repContact'])->name('rep-contact');
            // status
            Route::put('/orders/{order}/status/{status}', [OrderAdmin::class, 'updateStatus'])->name('admin-update-status');
        });
    });
});
/*admin*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'viewLoginAdmin'])->name('admin.viewLogin');
    Route::post('/login', [AuthAdminController::class, 'loginAdmin'])->name('admin.login');
});
/*end admin*
/* client*/
Route::prefix('auth')->group(function () {
    // login
    Route::get('login', [AuthClientController::class, 'viewLogin'])->name('client-viewLogin');
    Route::post('login', [AuthClientController::class, 'loginClient'])->name('client-login');
    Route::post('logout', [AuthClientController::class, 'logoutClient'])->name('client.logout');
    // register
    Route::get('register', [AuthClientController::class, 'viewRegister'])->name('client.viewRegister');
    Route::post('register', [AuthClientController::class, 'register'])->name('client.register');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify')
        ->middleware(['signed', 'throttle:6,1']);
    Route::view('success', 'client.auth.message.verify-email-success');
    Route::view('error', 'client.auth.message.verify-email-error');
    Route::view('error-outtime', 'client.auth.message.verify-token-outTime');
    Route::get('/verify-email', [AuthClientController::class, 'viewVerify'])->name('verify-email');
    // forgot password
    Route::get('forgot-password', [PasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');
});
/*home*/
// product home
Route::get('/', [ProductClient::class, 'listAllProductMain'])->name('home');
// product detail
Route::get('/detail/{slug}', [ProductClient::class, 'getProductDetail'])->name('detail');
// shop product
Route::get('/shop-product', [ProductClient::class, 'getProductShop'])->name('product');
// product parent
Route::get('/parent/{slug}', [ParentProductController::class, 'getProductParent'])->name('parent');
// filter product
Route::post('/filter-product', [ProductClient::class, 'search']);
// filter price
Route::get('/filter-price', [ProductClient::class, 'filterPrice']);
// search product
Route::get('/search-product', [SearchController::class, 'searchProduct'])->name('search-product');
Route::get('/search-dynamic', [SearchController::class, 'searchDynamic'])->name('search-dynamic');
// hit
Route::get('/search', [SearchController::class, 'index']);
/*and home*/


Route::get('/about', [SupportController::class, 'about'])->name('about');
Route::get('/policy', [SupportController::class, 'policy'])->name('policy');
Route::get('/return', [SupportController::class, 'return'])->name('return');
Route::get('/contact', [SupportController::class, 'contact'])->name('contact');
Route::post('/contact-post', [SupportController::class, 'store']);
// bài viết
Route::get('/article', [PostController::class, 'index'])->name('list-article');
Route::get('/article/{slug}', [PostController::class, 'show'])->name('detail-article');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
