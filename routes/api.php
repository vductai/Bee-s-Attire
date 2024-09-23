<?php


use App\Http\Controllers\admin\CategoryAPIController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductVariantController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SizeAPIController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VouchersAPIController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\client\ProfileController;
use App\Http\Controllers\client\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function (){
    // route admin và user mới dùng chung
    Route::group(['middleware' => ['checkRole:user,admin']], function (){


        Route::post('/logout', [AuthController::class, 'logout'] );
        // get profile
        Route::get('/profile', [AuthController::class, 'getProfile']);
        // update profile
        Route::put('/update-profile', [ProfileController::class, 'updateProfile']);



    });

    // route chỉ admin mới dùng được
    Route::group(['middleware' => ['checkRole:admin']], function (){

        // crud categories
        Route::resource('categories', CategoryAPIController::class);
        // crud role
        Route::resource('role', RolesController::class);
        // crud size
        Route::resource('size',SizeAPIController::class);
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

    });

});

Route::get('/search', [SearchController::class, 'searchProduct']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


