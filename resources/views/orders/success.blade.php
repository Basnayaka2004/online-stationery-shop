@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center px-4 py-16">

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl p-10 text-center">

        <!-- Success Icon -->
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-purple-700 mb-3">
            Order Placed Successfully!
        </h1>

        <!-- Message -->
        <p class="text-slate-600 mb-10">
            Thank you for your order. We'll process it shortly and send you updates via email.
        </p>

        <!-- Order Details Card -->
        <div class="bg-pink-50 rounded-2xl p-6 text-left shadow-inner">

            <div class="flex items-center gap-3 mb-6">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h2 class="text-xl font-bold text-purple-700">Order Details</h2>
            </div>

            <!-- Order Number -->
            <div class="flex justify-between items-center py-4 border-b border-pink-200">
                <span class="text-slate-600 font-medium">Order Number:</span>
                <span class="font-bold text-purple-700">
                    {{ $order->order_number }}
                </span>
            </div>

            <!-- Total Amount -->
            <div class="flex justify-between items-center py-4">
                <span class="text-slate-600 font-medium">Total Amount:</span>
                <span class="text-2xl font-bold text-purple-700">
                    Rs. {{ number_format($order->total_amount, 2) }}
                </span>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">

            <a href="{{ route('orders.index') }}"
               class="px-8 py-3 rounded-full bg-purple-600 text-white font-semibold hover:bg-purple-700 transition">
                View My Orders
            </a>

            <a href="{{ route('products.index') }}"
               class="px-8 py-3 rounded-full border-2 border-purple-600 text-purple-600 font-semibold hover:bg-purple-50 transition">
                Continue Shopping
            </a>

        </div>
    </div>
</div>
@endsection

