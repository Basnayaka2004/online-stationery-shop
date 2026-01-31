<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Routes accessible without authentication.
|
*/

// Login route - returns token
Route::post('login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
|
| Routes that require a valid Sanctum token.
|
*/

Route::middleware('auth:sanctum')->group(function () {

    // Logout route
    Route::post('logout', [AuthController::class, 'logout']);

    // API Resources
    Route::apiResource('admins', AdminController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('carts', CartController::class);
    Route::apiResource('cart-items', CartItemController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('order-items', OrderItemController::class);
    Route::apiResource('payments', PaymentController::class);
});

/*
|--------------------------------------------------------------------------
| Optional: Test Route
|--------------------------------------------------------------------------
|
| Simple route to quickly test if Sanctum is working.
|
*/
Route::middleware('auth:sanctum')->get('/test', function() {
    return response()->json([
        'message' => 'Sanctum authentication works!'
    ]);
});
