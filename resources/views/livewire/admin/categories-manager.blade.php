<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Manage Categories</h2>
        @if(!$showForm)
            <button wire:click="create" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium">
                + Add Category
            </button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Category' : 'Add New Category' }}</h3>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
                    <input type="text" wire:model="category_name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500" required>
                    @error('category_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium">
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Category Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Products Count</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($categories as $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $category->category_name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $category->products_count }} products</td>
                        <td class="px-6 py-4 text-sm">
                            <button wire:click="edit({{ $category->id }})" class="text-purple-600 hover:text-purple-800 mr-3">Edit</button>
                            <button wire:click="delete({{ $category->id }})" onclick="return confirm('Delete this category?')" class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-slate-500">No categories found. Click "Add Category" to create one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $categories->links() }}
        </div>
    </div>
</div>
