<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Customer Orders</h2>
        <select wire:model.live="statusFilter" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($orders as $order)
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Order #{{ $order->id }}</h3>
                        <p class="text-sm text-slate-600 mt-1">
                            Customer: <span class="font-medium">{{ $order->customer->name ?? 'N/A' }}</span> ({{ $order->customer->email ?? 'N/A' }})
                        </p>
                        <p class="text-sm text-slate-600">Date: {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" 
                                class="px-3 py-1 rounded-full text-sm font-medium border
                                @if($order->status === 'pending') bg-yellow-100 border-yellow-300 text-yellow-800
                                @elseif($order->status === 'processing') bg-blue-100 border-blue-300 text-blue-800
                                @elseif($order->status === 'completed') bg-green-100 border-green-300 text-green-800
                                @else bg-red-100 border-red-300 text-red-800 @endif">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-4">
                    <h4 class="font-medium text-slate-700 mb-2">Order Items:</h4>
                    <ul class="space-y-1">
                        @foreach($order->orderItems as $item)
                            <li class="text-sm text-slate-600 flex justify-between">
                                <span>{{ $item->cartItem->product->product_name ?? 'Product' }} × {{ $item->quantity }}</span>
                                <span class="font-medium">Rs.{{ number_format($item->price_at_purchase * $item->quantity, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 pt-3 border-t border-slate-200 flex justify-between items-center">
                        <span class="font-semibold text-slate-900">Total:</span>
                        <span class="text-lg font-bold text-green-600">
                            Rs.{{ number_format($order->orderItems->sum(function($item) { return $item->price_at_purchase * $item->quantity; }), 2) }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-12 text-center text-slate-500">
                No orders found.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
