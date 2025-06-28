<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FoodsController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
//    Route::post('/logout', 'logout');
});

// Public GET endpoints (contoh: lihat menu makanan)
Route::get('/foods', [FoodsController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // User management
    Route::apiResource('/user', UserController::class);
    Route::get('/user/current', function (Request $request) {
        return $request->user(); // Mengembalikan data user terautentikasi
    });

    // Food & Categories management (POST, PUT, DELETE)
    Route::apiResource('/foods', FoodsController::class)->except(['index']);
    Route::apiResource('/categories', CategoriesController::class)->except(['index']);

    // Orders
    Route::apiResource('/orders', OrdersController::class);
    Route::apiResource('/order_items', OrderItemController::class);

    // Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});
