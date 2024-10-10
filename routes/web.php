<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application.          |
| These routes are loaded by the RouteServiceProvider and all of them will |
| be assigned to the "web" middleware group. Make something great!         |
|--------------------------------------------------------------------------|
*/

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/listProduct', function () {
    return view('admin.product.list-product');
})->name('listProduct');

Route::get('/addProduct', function () {
    return view('admin.product.add-product');
})->name('addProduct');

Route::get('/editProduct', function () {
    return view('admin.product.edit-product');
})->name('editProduct');

Route::get('/addVariant', function () {
    return view('admin.variant.add-variant');
})->name('addVariant');



Route::get('/listColor', function () {
    return view('admin.color.list-color');
})->name('listColor');

Route::get('/addColor', function () {
    return view('admin.color.add-color');
})->name('addColor');

Route::get('/updateColor', function () {
    return view('admin.color.update-color');
})->name('updateColor');

Route::get('/listSize', function () {
    return view('admin.size.list-size');
})->name('listSize');

Route::get('/addSize', function () {
    return view('admin.size.add-size');
})->name('addSize');

Route::get('/updateSize', function () {
    return view('admin.size.update-size');
})->name('updateSize');



Route::get('/loginAdmin', function (){
    return view('admin.auth.login-admin');
})->name('loginAdmin');

/// admin
=======
// Group routes for authenticated users
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Routes for both admin and user roles
    Route::group(['middleware' => ['checkRole:user,admin']], function () {
        Route::post('/logout', [AuthAdminController::class, 'logoutAdmin'])->name('admin.logout');
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
        Route::post('/comment', [CommentController::class, 'comment']);
        Route::post('/addCart', [CartController::class, 'addCart'])->name('addCart');
        Route::get('/shoping-cart', [CartController::class, 'getCart'])->name('viewCart');
        Route::delete('/deleteCart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
        Route::delete('/deleteCartSlider/{id}', [CartController::class, 'deleteCartSlider'])->name('deleteCartSlider');
    });

    // Routes accessible only by admin
    Route::group(['middleware' => ['checkRole:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::resource('categories', CategoryAPIController::class);
            Route::resource('role', RolesController::class);
            Route::resource('size', SizeAPIController::class);
            Route::resource('user', UserController::class);
            Route::resource('voucher', VouchersAPIController::class);
            Route::resource('color', ColorController::class);
            Route::resource('product', ProductController::class);
            Route::resource('product-variant', ProductVariantController::class);
            Route::get('/', [AuthAdminController::class, 'dashboard'])->name('dashboard');
        });
    });
});

/* Admin Authentication */
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'viewLoginAdmin'])->name('admin.viewLogin');
    Route::post('/login', [AuthAdminController::class, 'loginAdmin'])->name('admin.login');
});

/* Client Authentication */
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthClientController::class, 'viewLogin'])->name('client.viewLogin');
    Route::post('login', [AuthClientController::class, 'loginClient'])->name('client.login');
    Route::post('logout', [AuthClientController::class, 'logoutClient'])->name('client.logout');

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

    Route::get('forgot-password', [PasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');
});

/* Home Routes */
Route::get('/', [ProductClient::class, 'listAllProductMain'])->name('home');
Route::get('/detail/{slug}', [ProductClient::class, 'getProductDetail'])->name('detail');
Route::get('/shop-product', [ProductClient::class, 'getProductShop'])->name('product');

/* Checkout Routes */
Route::get('/checkout', [CheckOutController::class, 'selectCart'])->name('checkout');
Route::post('/addVoucher', [CheckOutController::class, 'applyVoucher'])->name('addVoucher');

/* Static Pages */
Route::get('/about', function () {
    return view('client.us.about');
})->name('about');

Route::get('/contact', function () {
    return view('client.us.contact');
})->name('contact');

/* Check Login Status */
Route::get('/check-login', function () {
    return response()->json(['isLoggedIn' => auth()->check()]);
})->name('client.checkLogin');
>>>>>>> Stashed changes
