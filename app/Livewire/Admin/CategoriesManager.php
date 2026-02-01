<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoriesManager extends Component
{
    use WithPagination;

    public $categoryId, $category_name;
    public $isEditing = false;
    public $showForm = false;

    public function render()
    {
        return view('livewire.admin.categories-manager', [
            'categories' => Category::withCount('products')->latest()->paginate(10)
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
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        Category::create([
            'category_name' => $this->category_name,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        session()->flash('message', 'Category created successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->category_name = $category->category_name;
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $this->categoryId,
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'category_name' => $this->category_name,
        ]);

        session()->flash('message', 'Category updated successfully!');
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->products()->count() > 0) {
            session()->flash('error', 'Cannot delete category with existing products!');
            return;
        }
        $category->delete();
        session()->flash('message', 'Category deleted successfully!');
    }

    private function resetForm()
    {
        $this->categoryId = null;
        $this->category_name = '';
        $this->isEditing = false;
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }
}
