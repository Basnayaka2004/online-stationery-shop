<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Login
Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store']);

// Admin Protected Routes
Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');

    // Product Management
    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('products.index');

    // Category Management
    Route::get('/categories', function () {
        return view('admin.categories.index');
    })->name('categories.index');

    // Order Management
    Route::get('/orders', function () {
        return view('admin.orders.index');
    })->name('orders.index');
});
