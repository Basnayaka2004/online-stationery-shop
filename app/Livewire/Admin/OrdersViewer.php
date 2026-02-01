<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class OrdersViewer extends Component
{
    use WithPagination;

    public $statusFilter = '';

    public function render()
    {
        $query = Order::with(['customer', 'orderItems.cartItem.product']);

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.orders-viewer', [
            'orders' => $query->latest('order_date')->paginate(15)
        ]);
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $newStatus]);
        session()->flash('message', 'Order status updated successfully!');
    }
}
