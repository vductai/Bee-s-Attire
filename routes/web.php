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

Route::prefix('admin')->group(function (){
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
});



/// admin
