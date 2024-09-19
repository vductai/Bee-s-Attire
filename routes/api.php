<?php

use App\Http\Controllers\api\CategoryAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\RolesController;

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


Route::middleware('auth:sanctum')->group(function (){
    // cac route chi dung duoc khi dang nhap thanh cong


    Route::post('/logout', [UserController::class, 'logout'] );
    Route::apiResource('categories-api', CategoryAPIController::class);
    Route::apiResource('role', RolesController::class);



});


Route::get('/user/list', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
