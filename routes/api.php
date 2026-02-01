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
| Public Routes (no auth)
|--------------------------------------------------------------------------
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Public product & category listing for shop frontend
Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('api.products.show');
Route::get('categories', [CategoryController::class, 'index'])->name('api.categories.index');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
|
| Routes that require a valid Sanctum token.
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // Current user (customer) API token for Axios (create or return existing)
    Route::get('user/token', [AuthController::class, 'token']);
    Route::get('user', [AuthController::class, 'user']);

    // Customer-scoped: my cart, my orders (use current customer_id)
    Route::get('my-cart', [CartController::class, 'myCart']);
    Route::get('my-orders', [OrderController::class, 'myOrders']);

    // API Resources (full CRUD for authenticated clients)
    Route::apiResource('admins', AdminController::class)->names('api.admins');
    Route::apiResource('customers', CustomerController::class)->names('api.customers');
    Route::apiResource('products', ProductController::class)->names('api.products.auth');
    Route::apiResource('categories', CategoryController::class)->names('api.categories.auth');
    Route::apiResource('carts', CartController::class)->names('api.carts');
    Route::apiResource('cart-items', CartItemController::class)->names('api.cart-items');
    Route::apiResource('orders', OrderController::class)->names('api.orders');
    Route::apiResource('order-items', OrderItemController::class)->names('api.order-items');
    Route::apiResource('payments', PaymentController::class)->names('api.payments');
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
