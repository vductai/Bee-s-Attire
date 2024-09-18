<?php

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
    Route::get('/list', [RolesController::class, 'index']);
    Route::post('/role', [RolesController::class, 'store']);
    Route::put('/role/{id}', [RolesController::class, 'update']);
    Route::delete('/role/{id}', [RolesController::class, 'delete']);
    Route::post('/logout', [UserController::class, 'logout'] );
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
