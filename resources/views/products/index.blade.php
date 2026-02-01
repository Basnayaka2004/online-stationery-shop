@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Hero Section for Products Page -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Our <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Products</span>
                </h1>
                <p class="text-xl text-slate-700 max-w-2xl mx-auto font-medium leading-relaxed">
                    Discover high-quality stationery products for your home, office, and creative projects
                </p>
            </div>

            @livewire('product-list')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16 px-4 mt-16">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Magic Quill Logo" class="h-10 w-auto">
                        @elseif(file_exists(public_path('images/logo.jpg')))
                            <img src="{{ asset('images/logo.jpg') }}" alt="Magic Quill Logo" class="h-10 w-auto">
                        @elseif(file_exists(public_path('images/logo.svg')))
                            <img src="{{ asset('images/logo.svg') }}" alt="Magic Quill Logo" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">M</div>
                        @endif
                        <span class="text-xl font-bold">Magic Quill</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed">Your trusted source for premium office supplies and stationery products. Quality you can count on.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Shop by Category</h3>
                    <ul class="space-y-2 text-slate-400">
                        @php
                            $footerCategories = \App\Models\Category::orderBy('category_name')->get();
                        @endphp
                        @foreach($footerCategories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="hover:text-white transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    {{ $category->category_name }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors flex items-center gap-2 font-semibold text-blue-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                View All Products
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-slate-400">
                        @guest
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Customer Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Create Account</a></li>
                        @endguest
                        @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">My Dashboard</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">Shopping Cart</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-white transition-colors">My Orders</a></li>
                        @endauth
                        <li><a href="{{ url('/about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Admin Portal</h3>
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 px-4 py-3 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Admin Login
                    </a>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-slate-400">
                <p>&copy; 2026 MagicQuil. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection
