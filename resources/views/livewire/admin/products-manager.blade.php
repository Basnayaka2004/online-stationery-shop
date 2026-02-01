<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Manage Products</h2>
        @if(!$showForm)
            <button wire:click="create" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                + Add Product
            </button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Product' : 'Add New Product' }}</h3>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                        <input type="text" wire:model="product_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                        @error('product_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select wire:model="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price (Rs.) *</label>
                        <input type="number" step="0.01" wire:model="price" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                        <input type="number" wire:model="stock_quantity" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                        @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
                        <input type="url" wire:model="image_url" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('image_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if($image_url)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-1">Image Preview:</p>
                                <img src="{{ $image_url }}" alt="Product preview" class="w-32 h-32 object-cover rounded-lg border" onerror="this.style.display='none'">
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </button>
                    <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-medium">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200" onerror="this.src='https://via.placeholder.com/64?text=No+Image'">
                            @else
                                <div class="w-16 h-16 bg-slate-200 rounded-lg flex items-center justify-center text-slate-400 text-xs font-medium">No Image</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900">{{ $product->product_name }}</div>
                            <div class="text-sm text-slate-500">{{ Str::limit($product->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $product->category->category_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">Rs.{{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $product->stock_quantity }}</td>
                        <td class="px-6 py-4 text-sm">
                            <button wire:click="edit({{ $product->id }})" class="text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                            <button wire:click="delete({{ $product->id }})" onclick="return confirm('Delete this product?')" class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">No products found. Click "Add Product" to create one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $products->links() }}
        </div>
    </div>
</div>
