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

Route::get('/', function () {
    return view('client.page.home.index');
});

Route::get('/products', function() {
    return view('client.page.products.index');
});

Route::get('/products/{id}', function() {
    return view('client.page.product-detail.index');
});

Route::get('/auth/login', function() {
    return view('client.page.login.index');
});

Route::get('/auth/register', function() {
    return view('client.page.register.index');
});

Route::get('/blog', function() {
    return view('client.page.post.index');
});

Route::get('/blog/{id}', function() {
    return view('client.page.post-detail.index');
});

Route::get('/wishlist', function() {
    return view('client.page.wishlist.index');
});