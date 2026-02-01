<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;

class DashboardStats extends Component
{
    public $totalProducts;
    public $totalCategories;
    public $totalOrders;
    public $totalCustomers;

    public function mount()
    {
        $this->totalProducts = Product::count();
        $this->totalCategories = Category::count();
        $this->totalOrders = Order::count();
        $this->totalCustomers = Customer::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard-stats');
    }
}
