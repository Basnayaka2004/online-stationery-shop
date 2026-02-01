<div>
    <!-- Success Message -->
    @if($showSuccess)
        <div class="mb-6 rounded-2xl bg-green-50 border-2 border-green-200 p-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-green-900">Order Placed Successfully! 🎉</h3>
                    <p class="text-green-700">Your order has been confirmed and is being processed.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2 flex items-center gap-3">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            My Orders
        </h1>
        <p class="text-slate-600">Track and manage all your orders in one place</p>
    </div>

    @if(count($orders) === 0)
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-slate-900 mb-3">No orders yet</h2>
            <p class="text-slate-600 mb-8">Start shopping to see your orders here!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-full hover:shadow-xl hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Browse Products
            </a>
        </div>
    @else
        <!-- Orders List -->
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-slate-200 hover:shadow-2xl transition-all">
                    <!-- Order Header -->
                    <div class="flex flex-wrap items-start justify-between gap-4 mb-6 pb-6 border-b-2 border-slate-100">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">
                                Order #{{ $order['id'] }}
                            </h3>
                            <p class="text-slate-600 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($order['order_date'])->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <span 
                                class="inline-block px-5 py-2 rounded-full text-sm font-bold shadow-md
                                    {{ $order['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order['status'] === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order['status'] === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order['status'] === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}"
                            >
                                {{ ucfirst($order['status']) }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="space-y-4 mb-6">
                        <h4 class="font-bold text-slate-700 text-lg">Order Items:</h4>
                        @foreach($order['order_items'] as $item)
                            <div class="flex gap-4 p-4 bg-slate-50 rounded-xl">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    @php
                                        $imageUrl = $item['product']['image_url'] ?? 
                                                   ($item['cart_item']['product']['image_url'] ?? 
                                                   'https://via.placeholder.com/80x80/e2e8f0/64748b?text=Product');
                                        $productName = $item['product']['product_name'] ?? 
                                                      ($item['cart_item']['product']['product_name'] ?? 'Product');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $productName }}"
                                        class="w-20 h-20 rounded-lg object-cover"
                                    />
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h5 class="font-bold text-slate-900 mb-1">{{ $productName }}</h5>
                                    <div class="flex items-center gap-4 text-sm text-slate-600">
                                        <span>Qty: <span class="font-medium">{{ $item['quantity'] }}</span></span>
                                        <span>Price: <span class="font-medium text-indigo-600">Rs.{{ number_format($item['price_at_purchase'], 2) }}</span></span>
                                    </div>
                                </div>
                                
                                <!-- Item Total -->
                                <div class="text-right">
                                    <p class="text-lg font-bold text-indigo-600">
                                        Rs.{{ number_format($item['price_at_purchase'] * $item['quantity'], 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Total -->
                    <div class="flex justify-between items-center pt-6 border-t-2 border-slate-200">
                        <span class="text-lg font-semibold text-slate-700">Order Total:</span>
                        <span class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Rs.{{ number_format($this->calculateOrderTotal($order['order_items']), 2) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Loading indicator -->
    <div wire:loading class="fixed inset-0 bg-black/20 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 shadow-2xl">
            <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-indigo-600 mx-auto"></div>
            <p class="mt-4 text-slate-600">Loading orders...</p>
        </div>
    </div>
</div>
