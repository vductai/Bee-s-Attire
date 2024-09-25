<?php

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

Route::get('/admin', function () {
    return view('admin.page.index');
});

Route::get('/admin/product', function() {
    return view('admin.product.index');
});

Route::get('/admin/cart', function() {
    return view('admin.cart.index');
});

Route::get('/admin/category', function() {
    return view('admin.category.index');
});

Route::get('/admin/user', function() {
    return view('admin.user.index');
});

