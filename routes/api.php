<?php


use App\Http\Controllers\api\admin\CategoryAPIController;
use App\Http\Controllers\api\admin\RolesController;
use App\Http\Controllers\api\admin\SizeAPIController;
use App\Http\Controllers\api\admin\UserController;
use App\Http\Controllers\api\admin\VouchersAPIController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\client\ProfileController;
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
        // crud voucher
        Route::resource('voucher', VouchersAPIController::class);
        // crud user
        Route::resource('user', UserController::class);


    });

    // route chỉ admin mới dùng được
    Route::group(['middleware' => ['checkRole:admin']], function (){
        Route::post('/logout', [AuthController::class, 'logout'] );

        // crud categories
        Route::resource('categories', CategoryAPIController::class);
        // crud role
        Route::resource('role', RolesController::class);
        // crud size
        Route::resource('size',SizeAPIController::class);
        // crud user
        Route::resource('user', UserController::class);

    });

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


