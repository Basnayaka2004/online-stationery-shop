@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT -->
        <div class="lg:col-span-2 bg-white p-8 rounded-xl shadow">
            <h2 class="text-2xl font-semibold mb-6">Shipping Information</h2>

            <form method="POST" action="{{ route('checkout.place') }}">
                @csrf

                <!-- Full Name -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Full Name</label>
                    <input name="name"
                           class="w-full border rounded-lg px-4 py-3"
                           value="{{ auth()->user()->name }}"
                           required>
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Phone Number</label>
                    <input name="phone"
                           class="w-full border rounded-lg px-4 py-3"
                           placeholder="07XXXXXXXX"
                           required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input name="email"
                           class="w-full border rounded-lg px-4 py-3"
                           value="{{ auth()->user()->email }}"
                           readonly>
                </div>

                <!-- Address -->
                <div class="mb-6">
                    <label class="block mb-1 font-medium">Shipping Address</label>
                    <textarea name="address"
                              class="w-full border rounded-lg px-4 py-3"
                              rows="3"
                              required></textarea>
                </div>

                <!-- PAYMENT METHOD -->
                <h3 class="text-xl font-semibold mb-4">Payment Method</h3>

                <div class="space-y-4">

                    <!-- Cash on Delivery -->
                    <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:bg-slate-50">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <span class="font-medium">Cash on Delivery</span>
                    </label>

                    <!-- Card Payment -->
                    <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:bg-slate-50">
                        <input type="radio" name="payment_method" value="card">
                        <span class="font-medium">Credit / Debit Card</span>
                    </label>

                    <!-- Card Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-lg p-4 bg-slate-50">
                        <div>
                            <label class="block mb-1 text-sm">Card Number</label>
                            <input name="card_number"
                                   class="w-full border rounded-lg px-4 py-2"
                                   placeholder="1234 5678 9012 3456">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm">Card Holder Name</label>
                            <input name="card_name"
                                   class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm">Expiry Date</label>
                            <input name="expiry"
                                   class="w-full border rounded-lg px-4 py-2"
                                   placeholder="MM/YY">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm">CVV</label>
                            <input name="cvv"
                                   type="password"
                                   class="w-full border rounded-lg px-4 py-2"
                                   placeholder="***">
                        </div>
                    </div>

                </div>
        </div>

        <!-- RIGHT -->
        <div class="bg-pink-50 p-8 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-6">Order Summary</h2>

            @foreach($cartItems as $item)
                <div class="flex justify-between mb-3">
                    <div>
                        <p class="font-medium">{{ $item->product->product_name }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p>Rs. {{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            @endforeach

            <hr class="my-4">

            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>Rs. {{ number_format($subtotal, 2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Shipping</span>
                <span>Rs. {{ number_format($shipping, 2) }}</span>
            </div>

            <div class="flex justify-between text-lg font-semibold mt-4">
                <span>Total</span>
                <span class="text-purple-600">
                    Rs. {{ number_format($subtotal + $shipping, 2) }}
                </span>
            </div>

            <!-- PLACE ORDER -->
            <button type="submit"
                    class="mt-6 w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-full font-semibold">
                Place Order
            </button>
        </div>

        </form>
    </div>
</div>
@endsection
