<?php

use App\Http\Controllers\admin\CategoryAPIController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SizeAPIController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VouchersAPIController;
use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthClientController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CommentController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\ProductController as ProductClient;
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


/// admin
Route::group(['middleware' => ['auth:sanctum']], function () {
    // route admin và user dùng chung
    Route::group(['middleware' => ['checkRole:user,admin']], function () {
        Route::post('/logout', [AuthAdminController::class, 'logoutAdmin'])->name('admin.logout');
        // get profile
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
        // update profile
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
        //crud comment
        Route::post('/comment', [CommentController::class, 'comment']);
        // add cart
        Route::post('/addCart', [CartController::class, 'addCart'])->name('addCart');
        // get cart
        Route::get('/shoping-cart', [CartController::class, 'getCart'])->name('viewCart');
    });

    // route chỉ admin mới dùng được
    Route::group(['middleware' => ['checkRole:admin']], function () {

        Route::prefix('admin')->group(function () {
            // crud categories
            Route::resource('categories', CategoryAPIController::class);
            // crud role
            Route::resource('role', RolesController::class);
            // crud size
            Route::resource('size', SizeAPIController::class);
            // crud user
            Route::resource('user', UserController::class);
            // crud voucher
            Route::resource('voucher', VouchersAPIController::class);
            // crud color
            Route::resource('color', ColorController::class);
            // crud product
            Route::resource('product', ProductController::class);
            // crud product variant
            Route::resource('product-variant', ProductVariantController::class);

            Route::get('/', [AuthAdminController::class, 'dashboard'])->name('dashboard');
        });
    });


});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'viewLoginAdmin'])->name('admin.viewLogin');
    Route::post('/login', [AuthAdminController::class, 'loginAdmin'])->name('admin.login');
});

/* client*/
Route::prefix('auth')->group(function () {
    // login
    Route::get('login', [AuthClientController::class, 'viewLogin'])->name('client.viewLogin');
    Route::post('login', [AuthClientController::class, 'loginClient'])->name('client.login');
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


});

Route::get('/', [ProductClient::class, 'listAllProductMain'])->name('home');

Route::get('/product', function () {
    return view('client.product.show-product');
})->name('product');

Route::get('/detail/{id}', [ProductClient::class, 'getProductDetail'])->name('detail');

Route::get('/about', function () {
    return view('client.us.about');
})->name('about');

Route::get('/contact', function () {
    return view('client.us.contact');
})->name('contact');

Route::get('/checkout', function () {
    return view('client.check-out');
})->name('checkout');
