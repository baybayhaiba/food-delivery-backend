<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RouteListController;
use Illuminate\Support\Facades\Route;

Route::get('/api-docs/postman.json', [RouteListController::class, 'postmanCollection'])->name('api.docs.postman');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::prefix('restaurants')->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/{restaurant}', [RestaurantController::class, 'show']);
        Route::post('/', [RestaurantController::class, 'store'])->middleware('admin'); // Cần tạo AdminMiddleware sau
        Route::put('/{restaurant}', [RestaurantController::class, 'update'])->middleware('admin');
        Route::delete('/{restaurant}', [RestaurantController::class, 'destroy'])->middleware('admin');
        Route::get('/{restaurant}/dishes', [RestaurantController::class, 'dishes']);
    });
});
