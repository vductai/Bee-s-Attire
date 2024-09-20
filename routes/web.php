<?php

//use App\Http\Controllers\api\RolesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
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
Route::get('/', function (){
   return view('errors.404');
});

//Route::middleware('auth:sanctum')->group(function (){
//
//    // cac route chi dung duoc khi dang nhap thanh cong
//    Route::get('/list', [RolesController::class, 'index']);
//    Route::post('/role', [RolesController::class, 'store']);
//    Route::put('/role/{id}', [RolesController::class, 'update']);
//    Route::delete('/role/{id}', [RolesController::class, 'delete']);
//    Route::post('/logout', [UserController::class, 'logout'] );
//});
//
//
//Route::post('/register', [UserController::class, 'register']);
//Route::post('/login', [UserController::class, 'login']);


Auth::routes();


