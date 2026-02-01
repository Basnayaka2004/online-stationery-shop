<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public $selectedCategory = '';
    public $searchTerm = '';

    public function mount()
    {
        // Check if category is passed via URL parameter
        if (request()->has('category')) {
            $this->selectedCategory = request()->get('category');
        }
    }

    public function filterByCategory($categoryId): void
    {
        $this->selectedCategory = $categoryId;
    }

    public function clearFilter(): void
    {
        $this->selectedCategory = '';
        $this->searchTerm = '';
    }

    public function addToCart($productId, $productName)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $customer = Auth::user();

        // Get or create cart
        $cart = Cart::firstOrCreate(
            ['customer_id' => $customer->id],
            ['customer_id' => $customer->id]
        );

        // Check if product already in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Create new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        // Flash success message
        session()->flash('cart_message', $productName . ' added to cart!');

        // Dispatch browser event for notification
        $this->dispatch('item-added', productName: $productName);
    }

    public function getProductsProperty()
    {
        $query = Product::with('category');
        
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }
        
        if ($this->searchTerm) {
            $query->where('product_name', 'like', '%' . $this->searchTerm . '%');
        }
        
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('category_name')->get();
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => $this->products,
            'categories' => $this->categories,
        ]);
    }
}
