<?php

use App\Http\Controllers\admin\CategoryAPIController;
use App\Http\Controllers\admin\CategoryParentController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\CouponUserController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SizeAPIController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VoucherController;
use App\Http\Controllers\admin\VouchersAPIController;
use App\Http\Controllers\admin\OrderController as OrderAdmin;

use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthClientController;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\PasswordController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckOutController;
use App\Http\Controllers\client\CheckPaymentMethodController;
use App\Http\Controllers\client\CommentController;
use App\Http\Controllers\client\MoMoController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\ParentProductController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\ProductController as ProductClient;
use App\Http\Controllers\client\VNPayController;
use App\Http\Controllers\client\WishListController;
use App\Jobs\SendMailVoucherExpiredJob;
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
