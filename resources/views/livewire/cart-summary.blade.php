<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    @if (count($cartItems) === 0)
        <!-- Empty Cart State -->
        <div class="text-center py-20">
            <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-slate-900 mb-3">Your cart is empty</h2>
            <p class="text-slate-600 mb-8">Start shopping and add items to your cart!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-full hover:shadow-xl hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Start Shopping
            </a>
        </div>
    @else
        <!-- Cart Items -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items List -->
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Shopping Cart ({{ count($cartItems) }})
                </h2>

                @foreach($cartItems as $item)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all border border-slate-200">
                        <div class="flex gap-6">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <img 
                                    src="{{ $item['product']['image_url'] ?? 'https://via.placeholder.com/120x120/e2e8f0/64748b?text=Product' }}" 
                                    alt="{{ $item['product']['product_name'] ?? 'Product' }}"
                                    class="w-24 h-24 rounded-xl object-cover"
                                />
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $item['product']['product_name'] ?? 'Product' }}</h3>
                                <p class="text-sm text-slate-600 mb-3">{{ Str::limit($item['product']['description'] ?? '', 80) }}</p>
                                
                                <div class="flex items-center gap-4 flex-wrap">
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-2 bg-slate-100 rounded-lg p-1">
                                        <button 
                                            wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                            @if($item['quantity'] <= 1) disabled @endif
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white hover:bg-slate-200 disabled:opacity-50 disabled:cursor-not-allowed font-bold text-slate-700"
                                        >−</button>
                                        <span class="w-12 text-center font-bold text-slate-900">{{ $item['quantity'] }}</span>
                                        <button 
                                            wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                            @if($item['quantity'] >= ($item['product']['stock_quantity'] ?? 999)) disabled @endif
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white hover:bg-slate-200 disabled:opacity-50 disabled:cursor-not-allowed font-bold text-slate-700"
                                        >+</button>
                                    </div>

                                    <!-- Price -->
                                    <div class="text-lg font-bold text-indigo-600">
                                        Rs.{{ number_format(($item['product']['price'] ?? 0) * $item['quantity'], 2) }}
                                    </div>

                                    <!-- Remove Button -->
                                    <button 
                                        wire:click="removeItem({{ $item['id'] }})"
                                        wire:confirm="Remove this item from cart?"
                                        class="ml-auto text-red-600 hover:text-red-700 font-medium flex items-center gap-1"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl p-8 sticky top-24">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-slate-700">
                            <span>Subtotal ({{ count($cartItems) }} items):</span>
                            <span class="font-bold">Rs.{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-700">
                            <span>Delivery:</span>
                            <span class="font-bold text-green-600">{{ $delivery == 0 ? 'FREE' : '$' . number_format($delivery, 2) }}</span>
                        </div>
                        <div class="border-t-2 border-slate-300 pt-4">
                            <div class="flex justify-between text-xl font-bold text-slate-900">
                                <span>Total:</span>
                                <span class="text-indigo-600">Rs.{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    @if($subtotal < 25)
                        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-lg p-3 mb-4 text-sm">
                            💡 Add Rs.{{ number_format(25 - $subtotal, 2) }} more for FREE delivery!
                        </div>
                    @endif

                   
                    <a href="{{ route('checkout') }}" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">

    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>

    Proceed to Checkout
</a>


                    <a href="{{ route('products.index') }}" class="block text-center mt-4 text-indigo-600 hover:text-indigo-700 font-medium">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Loading indicator -->
    <div wire:loading class="fixed inset-0 bg-black/20 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 shadow-2xl">
            <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-indigo-600 mx-auto"></div>
            <p class="mt-4 text-slate-600">Processing...</p>
        </div>
    </div>
</div>
