<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CategoryAPIController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\CouponUserController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SizeAPIController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VouchersAPIController;
use App\Http\Controllers\admin\OrderController as OrderAdmin;

use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthClientController;
use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckOutController;
use App\Http\Controllers\client\CheckPaymentMethodController;
use App\Http\Controllers\client\CommentController;
use App\Http\Controllers\client\MoMoController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\ProductController as ProductClient;
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


Route::group(['middleware' => ['auth:sanctum']], function () {
    // route admin và user dùng chung
    Route::group(['middleware' => ['checkRole:user,admin', 'web']], function () {
        Route::post('/logout', [AuthAdminController::class, 'logoutAdmin'])->name('admin.logout');
        // get profile
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
        // update profile
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
        // wishlist
        Route::get('/wish-list', [WishListController::class, 'index'])->name('list-wish');
        Route::post('/wish-list/add', [WishListController::class, 'addToWishlist'])->name('add-wishlist');
        Route::delete('/wish-list/delete/{id}', [WishListController::class, 'deleteWishlist'])->name('delete-wishlist');

        //crud comment
        Route::post('/comment', [CommentController::class, 'comment']);
        // add cart
        Route::post('/addCart', [CartController::class, 'addCart'])->name('addCart');
        // get cart
        Route::get('/shoping-cart', [CartController::class, 'getCart'])->name('viewCart');
        // delete cart
        Route::delete('/deleteCart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
        Route::delete('/deleteCartSlider/{id}', [CartController::class, 'deleteCartSlider'])->name('deleteCartSlider');

        // online checkout
        Route::post('online-checkout', [CheckPaymentMethodController::class, 'onlineCheckOut'])->name('check-payment-method');

        // vnpay
        Route::get('/vnpay', [VNPayController::class, 'createPayment'])->name('create-payment');
        Route::get('/order-success', [VNPayController::class, 'handlePaymentReturn'])->name('vnpay-return');
        // momo
        Route::get('/return-momo', [VNPayController::class, 'orderSuccessMono'])->name('momo-return');


        // get order
        Route::get('/order', [OrderController::class, 'getAllOrder'])->name('get-all-order');

    });

    // route chỉ admin mới dùng được
    Route::group(['middleware' => ['checkRole:admin', 'web']], function () {

        Route::prefix('admin')->group(function () {
            // voucher
            Route::get('/coupon-user', [CouponUserController::class, 'formAdd'])->name('add-form-coupon-user');
            Route::post('/coupon-user', [CouponUserController::class, 'store'])->name('add-coupon-user');
            Route::delete('/coupon-user/{id}', [CouponUserController::class, 'delete'])->name('delete-coupon');

            // crud categories
            Route::resource('categories', CategoryAPIController::class);
            // crud role
            Route::resource('role', RolesController::class);
            // crud size
            Route::resource('size', SizeAPIController::class);
            // crud user
            Route::resource('user', UserController::class);
            // crud voucher
            Route::resource('coupon', VouchersAPIController::class);
            // crud color
            Route::resource('color', ColorController::class);
            // crud product
            Route::resource('product', ProductController::class);

            Route::resource('banners', BannerController::class);

            // crud product variant
            Route::resource('product-variant', ProductVariantController::class);
            // dashboard
            Route::get('/', [AuthAdminController::class, 'dashboard'])->name('dashboard');
            // action user, product
            Route::post('/action/{id}', [AuthAdminController::class, 'toggleUserStatus'])->name('action-user');
            Route::post('/actionProduct/{id}', [AuthAdminController::class, 'toggleProductStatus'])->name('action-product');

            // order
            Route::get('/order', [OrderAdmin::class, 'listOrder'])->name('admin-list-order');
            Route::get('/order/{id}/detail', [OrderAdmin::class, 'detailOrder'])->name('admin-order-detail');
            Route::get('/export-order', [OrderAdmin::class, 'export'])->name('export-order');
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

/*end admin*/

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
    Route::get('success', function () {
        return view('client.auth.message.verify-email-success');
    })->name('success');
    Route::get('error', function () {
        return view('client.auth.message.verify-email-error');
    })->name('error');

    // forgot password
    Route::get('forgot-password', [PasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');

})->middleware(['web']);


/*home*/

// product home
Route::get('/', [ProductClient::class, 'listAllProductMain'])->name('home');
// product detail
Route::get('/detail/{slug}', [ProductClient::class, 'getProductDetail'])->name('detail');
// shop product
Route::get('/shop-product', [ProductClient::class, 'getProductShop'])->name('product');

/*and home*/
Route::get('/tag/search', [ProductClient::class, 'searchTag'])->name('tag');
/* check out*/

Route::get('/checkout', [CheckOutController::class, 'selectCart'])->name('checkout');

Route::post('/addVoucher', [CheckOutController::class, 'applyVoucher'])->name('addVoucher');

/*end check out*/
Route::get('/about', function () {
    return view('client.us.about');
})->name('about');

Route::get('/contact', function () {
    return view('client.us.contact');
})->name('contact');

Route::get('login', [AuthClientController::class, 'viewLogin'])->name('client.viewLogin');

 