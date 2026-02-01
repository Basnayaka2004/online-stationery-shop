<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartSummary extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $delivery = 0;
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $customer = Auth::user();
        
        if (!$customer) {
            $this->cartItems = [];
            return;
        }

        $cart = Cart::where('customer_id', $customer->id)->first();
        
        if ($cart) {
            $this->cartItems = CartItem::where('cart_id', $cart->id)
                ->with('product.category')
                ->get()
                ->toArray();
        } else {
            $this->cartItems = [];
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum(function ($item) {
            return ($item['product']['price'] ?? 0) * ($item['quantity'] ?? 0);
        });

        $this->delivery = $this->subtotal >= 25 ? 0 : 4.99;
        $this->total = $this->subtotal + $this->delivery;
    }

    public function updateQuantity($itemId, $newQuantity)
    {
        if ($newQuantity < 1) {
            return;
        }

        $cartItem = CartItem::find($itemId);
        
        if ($cartItem) {
            $cartItem->update(['quantity' => $newQuantity]);
            session()->flash('message', 'Quantity updated!');
            $this->loadCart();
        }
    }

    public function removeItem($itemId)
    {
        $cartItem = CartItem::find($itemId);
        
        if ($cartItem) {
            $cartItem->delete();
            session()->flash('message', 'Item removed from cart!');
            $this->loadCart();
        }
    }

    public function checkout()
    {
        try {
            $customer = Auth::user();
            
            if (!$customer) {
                session()->flash('error', 'Please log in to checkout');
                return redirect()->route('login');
            }

            $cart = Cart::where('customer_id', $customer->id)->first();
            
            if (!$cart || count($this->cartItems) === 0) {
                session()->flash('error', 'Your cart is empty');
                return;
            }

            // Create order
            $order = \App\Models\Order::create([
                'cart_id' => $cart->id,
                'customer_id' => $customer->id,
                'status' => 'pending',
                'order_date' => now()->format('Y-m-d'),
            ]);

            // Create order items
            foreach ($this->cartItems as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'cart_item_id' => $item['id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $item['product']['price'] ?? 0,
                ]);
            }

            // Clear cart items
            CartItem::where('cart_id', $cart->id)->delete();

            // Flash success message
            session()->flash('checkout_success', true);

            return redirect()->route('orders.index', ['success' => 1]);
            
        } catch (\Exception $e) {
            \Log::error('Checkout error: ' . $e->getMessage());
            session()->flash('error', 'Checkout failed: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
