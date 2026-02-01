<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrdersList extends Component
{
    public $orders = [];
    public $showSuccess = false;

    public function mount()
    {
        // Check if redirected from successful checkout
        if (request()->has('success')) {
            $this->showSuccess = true;
        }

        $this->loadOrders();
    }

    public function loadOrders()
    {
        $customer = Auth::user();
        
        if (!$customer) {
            $this->orders = [];
            return;
        }

        $orders = Order::where('customer_id', $customer->id)
            ->with(['orderItems.product.category'])
            ->orderBy('order_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Convert to array and ensure product data is accessible
        $this->orders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'order_date' => $order->order_date,
                'status' => $order->status,
                'order_items' => $order->orderItems->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'quantity' => $item->quantity,
                        'price_at_purchase' => $item->price_at_purchase,
                        'product' => $item->product ? [
                            'id' => $item->product->id,
                            'product_name' => $item->product->product_name,
                            'image_url' => $item->product->image_url,
                            'description' => $item->product->description,
                        ] : null,
                    ];
                })->toArray(),
            ];
        })->toArray();
    }

    public function calculateOrderTotal($orderItems)
    {
        return collect($orderItems)->sum(function ($item) {
            return ($item['price_at_purchase'] ?? 0) * ($item['quantity'] ?? 0);
        });
    }

    public function render()
    {
        return view('livewire.orders-list');
    }
}
