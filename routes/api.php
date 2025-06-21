<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FoodsController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/user', UserController::class);
Route::apiResource('/categories', CategoriesController::class);
Route::apiResource('/foods', FoodsController::class);
Route::apiResource('/orders', OrdersController::class);
Route::apiResource('/order_items', OrderItemController::class);
