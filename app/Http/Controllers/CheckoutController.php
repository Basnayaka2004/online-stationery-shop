<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer = auth()->user();

        $cart = Cart::where('customer_id', $customer->id)
            ->with('cartItems.product')
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        $subtotal = $cart->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', [
            'cart' => $cart,
            'cartItems' => $cart->cartItems,
            'subtotal' => $subtotal,
            'shipping' => 300,
        ]);
    }
    
     public function placeOrder(Request $request)
    {
        // later: validation + save order
        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully!');
    }
}
