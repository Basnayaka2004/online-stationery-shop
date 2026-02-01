<div class="product-list-container">
    <!-- Success Message -->
    @if (session()->has('cart_message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 text-green-700 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span>{{ session('cart_message') }}</span>
        </div>
    @endif

    <!-- Category Filter -->
    @if($selectedCategory)
        @php
            $selectedCategoryName = $categories->firstWhere('id', $selectedCategory)?->category_name ?? 'Unknown';
        @endphp
        <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-2 border-blue-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">{{ $selectedCategoryName }}</h2>
                    <p class="text-slate-700 font-medium">Showing {{ count($products) }} products in this category</p>
                </div>
                <button
                    wire:click="clearFilter"
                    class="px-6 py-3 bg-white hover:bg-blue-50 rounded-lg text-sm font-bold transition-all shadow-sm border border-blue-300 text-slate-900 flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    View All Categories
                </button>
            </div>
        </div>
    @endif

    <div class="mb-8 flex flex-wrap items-center gap-4 bg-white rounded-xl shadow-sm border border-blue-100 p-4">
        <label class="font-bold text-slate-900">Filter by Category:</label>
        <select
            wire:model.live="selectedCategory"
            class="rounded-lg border-blue-200 bg-white text-slate-900 font-semibold shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2"
        >
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
        <span class="text-sm text-slate-700 ml-auto font-semibold">{{ count($products) }} products found</span>
    </div>

    <!-- Loading State -->
    <div wire:loading class="text-center py-20">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        <p class="text-slate-900 mt-4 font-bold">Loading amazing products...</p>
    </div>

    <!-- Products Grid -->
    <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white border border-blue-100 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-300 group">
                <!-- Product Image -->
                <div class="aspect-[4/3] overflow-hidden bg-slate-100 relative">
                    <img 
                        src="{{ $product->image_url ?: 'https://via.placeholder.com/400x300/e2e8f0/64748b?text=' . urlencode($product->product_name) }}" 
                        alt="{{ $product->product_name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        loading="lazy"
                    />
                    <div class="absolute top-3 right-3 bg-blue-600 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-bold text-white shadow-lg">
                        Rs.{{ number_format($product->price, 2) }}
                    </div>
                    @if($product->stock_quantity < 10 && $product->stock_quantity > 0)
                        <div class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                            Only {{ $product->stock_quantity }} left!
                        </div>
                    @endif
                    @if($product->stock_quantity === 0)
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                            <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-5">
                    <h3 class="font-bold text-slate-900 text-lg mb-2 line-clamp-2 min-h-[3.5rem] group-hover:text-blue-600 transition-colors">
                        {{ $product->product_name }}
                    </h3>
                    <p class="text-slate-700 text-sm mb-3 line-clamp-2 min-h-[2.5rem] font-medium">
                        {{ $product->description ?: 'High-quality stationery product' }}
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        @if($product->category)
                            <span class="text-sm text-slate-700 font-semibold">
                                <span class="inline-block w-2 h-2 rounded-full bg-blue-600 mr-1"></span>
                                {{ $product->category->category_name }}
                            </span>
                        @endif
                        <span class="text-sm font-bold {{ $product->stock_quantity > 20 ? 'text-green-600' : ($product->stock_quantity > 0 ? 'text-orange-600' : 'text-red-600') }}">
                            @if($product->stock_quantity > 0)
                                {{ $product->stock_quantity }} in stock
                            @else
                                Out of stock
                            @endif
                        </span>
                    </div>

                    <!-- Add to Cart Button -->
                    @auth
                        <button
                            wire:click="addToCart({{ $product->id }}, '{{ addslashes($product->product_name) }}')"
                            wire:loading.attr="disabled"
                            @disabled($product->stock_quantity < 1)
                            class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed transition-all flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="addToCart">{{ $product->stock_quantity < 1 ? 'Out of Stock' : 'Add to Cart' }}</span>
                            <span wire:loading wire:target="addToCart">Adding...</span>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="block text-center py-3 px-4 bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 font-semibold rounded-xl transition-all">
                            🔐 Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-3xl font-bold text-slate-900 mb-3">No products found</h3>
                <p class="text-slate-700 text-lg font-medium">Try selecting a different category</p>
            </div>
        @endforelse
    </div>
</div>

<script>
// Listen for item-added event
document.addEventListener('livewire:init', () => {
    Livewire.on('item-added', (event) => {
        const productName = event.productName || 'Product';
        showNotification('✅ ' + productName + ' added to cart!');
    });
});

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 px-6 py-4 rounded-xl shadow-2xl z-50 animate-bounce bg-blue-600 border border-blue-500 text-white font-bold';
    notification.innerHTML = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}
</script>
