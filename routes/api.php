<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/registration', [AuthController::class, 'registration']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/get', [AuthController::class, 'get']);
Route::post('/getAll', [AuthController::class, 'getAll']);
Route::post('/update/{id}', [AuthController::class, 'update'])->middleware('auth:sanctum');
Route::post('/delete/{id}', [AuthController::class, 'delete']);
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::group(['prefix' => '/product'], function () {
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/get', [ProductController::class, 'get']);
    Route::post('/detail/{id}', [ProductController::class, 'detail']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
    Route::post('/delete/{id}', [ProductController::class, 'delete']);
});

Route::group(['prefix' => '/order'], function () {
    Route::post('/makeOrder', [OrderController::class, 'makeOrder']);
    Route::post('/get', [OrderController::class, 'get']);
    Route::post('/detail/{id}', [OrderController::class, 'detail']);
    Route::post('/update/{id}', [OrderController::class, 'update']);
    Route::post('/delete/{id}', [OrderController::class, 'delete']);
});