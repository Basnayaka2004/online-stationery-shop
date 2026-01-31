<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $customer  = Customer::factory(5)->create();
        $product   = Product::factory(10)->create();
        $cart      = Cart::factory(5)->create();
        $cartItem  = CartItem::factory(10)->create();
        $category  = Category::factory(5)->create();
        $admin     = Admin::factory(3)->create();
        $order     = Order::factory(5)->create();
        $orderItem = OrderItem::factory(10)->create();
        $payment   = Payment::factory(5)->create();
       
        
    }
}
