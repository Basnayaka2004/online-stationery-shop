@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold text-slate-900 mb-4">About Magic Quill</h1>
        <p class="mt-4 text-slate-700 text-lg max-w-3xl mx-auto font-medium leading-relaxed">
            Your one-stop destination for quality stationery products that inspire creativity,
            learning, and productivity.
        </p>
    </div>
</section>

<!-- About Content -->
<section class="bg-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

        <!-- Image -->
        <div>
            <img 
                src="https://images.unsplash.com/photo-1519682337058-a94d519337bc"
                alt="Stationery items"
                class="rounded-2xl shadow-xl border border-blue-100"
            >
        </div>

        <!-- Text -->
        <div>
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Who We Are</h2>
            <p class="text-slate-700 leading-relaxed mb-4 font-medium">
                We are an online stationery shop dedicated to providing high-quality products
                for students, teachers, professionals, and creatives. From notebooks and pens
                to office essentials, we carefully select every item to ensure durability and style.
            </p>
            <p class="text-slate-700 leading-relaxed font-medium">
                Our goal is to make stationery shopping easy, affordable, and enjoyable through
                a smooth online experience and reliable customer service.
            </p>
        </div>

    </div>
</section>

<!-- Mission & Vision -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-8">

        <!-- Mission -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 p-8 rounded-2xl shadow-lg">
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Our Mission</h3>
            <p class="text-slate-700 font-medium leading-relaxed">
                To deliver premium stationery products at affordable prices while ensuring
                excellent customer satisfaction and fast delivery.
            </p>
        </div>

        <!-- Vision -->
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-100 p-8 rounded-2xl shadow-lg">
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Our Vision</h3>
            <p class="text-slate-700 font-medium leading-relaxed">
                To become a trusted and leading online stationery store by continuously improving
                product quality, service, and innovation.
            </p>
        </div>

    </div>
</section>

<!-- Why Choose Us -->
<section class="bg-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-slate-900 mb-10">Why Choose Us?</h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white border border-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all">
                <h4 class="text-xl font-bold text-slate-900 mb-3">Quality Products</h4>
                <p class="text-slate-700 font-medium leading-relaxed">
                    We provide carefully selected stationery items that meet high quality standards.
                </p>
            </div>

            <div class="bg-white border border-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all">
                <h4 class="text-xl font-bold text-slate-900 mb-3">Affordable Prices</h4>
                <p class="text-slate-700 font-medium leading-relaxed">
                    Competitive pricing ensures you get the best value for your money.
                </p>
            </div>

            <div class="bg-white border border-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all">
                <h4 class="text-xl font-bold text-slate-900 mb-3">Fast & Reliable Service</h4>
                <p class="text-slate-700 font-medium leading-relaxed">
                    Quick order processing and dependable delivery you can trust.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-slate-900 text-white py-16 px-4">
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
            <p>&copy;2026 MagicQuil. All rights reserved.</p>
        </div>
    </div>
</footer>

@endsection
