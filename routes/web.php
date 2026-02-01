<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes - Online Stationery Shop
|--------------------------------------------------------------------------
*/


Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

// Landing page (public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Product catalog (public)
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/{id}', function ($id) {
    return view('products.show', ['id' => $id]);
})->name('products.show')->whereNumber('id');

// Debug cart route
Route::get('/debug-cart', function () {
    $customer = auth()->user();
    if (!$customer) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $cart = \App\Models\Cart::where('customer_id', $customer->id)->first();
    if (!$cart) {
        return response()->json(['error' => 'No cart found']);
    }
    
    $cartItems = $cart->cartItems()->with('product')->get();
    
    return response()->json([
        'cart_id' => $cart->id,
        'customer_id' => $customer->id,
        'items_count' => $cartItems->count(),
        'items' => $cartItems
    ]);
})->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

/*
|--------------------------------------------------------------------------
| Authenticated routes (Jetstream + Sanctum session)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Return API token for Axios (session-authenticated)
    Route::get('/api-token', [AuthController::class, 'token'])->name('api.token');

    Route::get('/cart', function () {
        return view('cart.index');
    })->name('cart.index');

    // Checkout (THIS IS THE IMPORTANT PART)
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.place');

    Route::get('/orders', function () {
        return view('orders.index');
    })->name('orders.index');
});
