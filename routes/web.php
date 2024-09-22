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
    return view('pages.client.home.index');
});

Route::get('/products', function() {
    return view('pages.client.products.index');
});

Route::get('/products/{id}', function() {
    return view('pages.client.product-detail.index');
});

Route::get('/auth/login', function() {
    return view('pages.client.login.index');
});

Route::get('/auth/register', function() {
    return view('pages.client.register.index');
});

Route::get('/blog', function() {
    return view('pages.client.post.index');
});

Route::get('/blog/{id}', function() {
    return view('pages.client.post-detail.index');
});

Route::get('/wishlist', function() {
    return view('pages.client.wishlist.index');
});