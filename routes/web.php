<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;



//Route::get('test', function () {
    //return view('welcome');

    // 1️ Admin → Products
    //$admin = Admin::find(1);
    //return $admin->products;

    // 2️ Admin → Categories
    // return $admin->categories;

    // 3️ Category → Products
    // $category = Category::find(1);
    // return $category->products;

    // 4️ Product → Category
    // $product = Product::find(1);
    // return $product->category;

    // 5️ Customer → Cart
    // $customer = Customer::find(1);
    // return $customer->cart;

    // 6️ Cart → Cart Items
    // $cart = Cart::find(1);
    // return $cart->cartItems;

    // 7️ CartItem → Product
    // $cartItem = CartItem::find(1);
    // return $cartItem->product;

    // 8️ Customer → Payments
    // return $customer->payment;

    // 9️ Order → Order Items
    // $order = Order::find(1);
    // return $order->orderItems;

    //10 Order → Customer
    // return $order->customer;

    // 1️1️ Payment → Order
    // $payment = Payment::find(1);
    // return $payment->order;
/*});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/
