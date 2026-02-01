<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductsManager extends Component
{
    use WithPagination;

    public $productId, $product_name, $description, $price, $stock_quantity, $category_id, $image_url;
    public $isEditing = false;
    public $showForm = false;

    public function render()
    {
        return view('livewire.admin.products-manager', [
            'products' => Product::with('category')->latest()->paginate(10),
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function store()
    {
        $this->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url|max:500',
        ]);

        Product::create([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'image_url' => $this->image_url,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        session()->flash('message', 'Product created successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->product_name = $product->product_name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->category_id = $product->category_id;
        $this->image_url = $product->image_url;
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url|max:500',
        ]);

        $product = Product::findOrFail($this->productId);
        $product->update([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'image_url' => $this->image_url,
        ]);

        session()->flash('message', 'Product updated successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    private function resetForm()
    {
        $this->productId = null;
        $this->product_name = '';
        $this->description = '';
        $this->price = '';
        $this->stock_quantity = '';
        $this->category_id = '';
        $this->image_url = '';
        $this->isEditing = false;
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }
}
