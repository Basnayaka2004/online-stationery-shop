<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} – Premium Stationery & Office Supplies</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 antialiased">
    <!-- Header -->
    <header class="bg-slate-900 backdrop-blur-md border-b border-slate-800 shadow-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="Magic Quill Logo" class="h-12 w-auto group-hover:scale-110 transition-transform">
                    @elseif(file_exists(public_path('images/logo.jpg')))
                        <img src="{{ asset('images/logo.jpg') }}" alt="Magic Quill Logo" class="h-12 w-auto group-hover:scale-110 transition-transform">
                    @elseif(file_exists(public_path('images/logo.svg')))
                        <img src="{{ asset('images/logo.svg') }}" alt="Magic Quill Logo" class="h-12 w-auto group-hover:scale-110 transition-transform">
                    @else
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">MQ</div>
                    @endif
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold text-white hidden sm:block leading-tight">Magic Quill</span>
                        <span class="text-xs text-slate-400 hidden sm:block">Premium Stationery</span>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-2">
                    <a href="{{ route('products.index') }}" class="px-5 py-2.5 text-slate-200 hover:text-white hover:bg-slate-800 font-semibold rounded-lg transition-all">Shop</a>
                    <a href="{{ url('/about') }}" class="px-5 py-2.5 text-slate-200 hover:text-white hover:bg-slate-800 font-semibold rounded-lg transition-all">About</a>
                    <a href="{{ url('/contact') }}" class="px-5 py-2.5 text-slate-200 hover:text-white hover:bg-slate-800 font-semibold rounded-lg transition-all">Contact</a>
                    
                    <!-- Divider -->
                    <div class="h-6 w-px bg-slate-700 mx-2"></div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-slate-200 hover:text-amber-400 hover:bg-slate-800 font-semibold rounded-lg transition-all">Dashboard</a>
                        <a href="{{ route('cart.index') }}" class="relative px-4 py-2 text-slate-200 hover:text-amber-400 hover:bg-slate-800 font-semibold rounded-lg transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Cart
                            @php
                                $cartCount = 0;
                                if (Auth::check()) {
                                    $cart = \App\Models\Cart::where('customer_id', Auth::id())->first();
                                    if ($cart) {
                                        $cartCount = $cart->cartItems()->count();
                                    }
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-900/30 font-semibold rounded-lg transition-all">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-slate-200 hover:text-white hover:bg-slate-800 font-semibold rounded-lg transition-all">Log in</a>
                        <a href="{{ route('register') }}" class="ml-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full hover:shadow-xl hover:scale-105 transition-all">
                            Get Started
                        </a>
                    @endauth
                </nav>
                
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-slate-800 text-slate-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-20 pb-32 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block mb-6 px-5 py-2 bg-blue-600 text-white border border-blue-700 rounded-full text-sm font-bold animate-bounce shadow-lg">
                    ✨ Free Delivery on Orders Over Rs.2500
                </div>
                <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-slate-900 mb-8 leading-tight">
                    Your Premium
                    <br>
                    <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 bg-clip-text text-transparent">Writing</span>
                    <br>
                    Experience
                </h1>
                <p class="text-xl md:text-2xl text-slate-700 mb-12 max-w-3xl mx-auto leading-relaxed font-medium">
                    Discover premium pens, notebooks, planners, and office supplies. 
                    <span class="font-bold text-blue-700">Quality products</span>, unbeatable prices, and fast delivery.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-bold rounded-full hover:shadow-2xl hover:scale-105 transition-all transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span>Start Shopping</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-10 py-5 border-3 border-blue-600 text-blue-600 text-lg font-bold rounded-full hover:bg-blue-50 transition-all">
                        Create Account
                    </a>
                    @endguest
                </div>
            </div>

            <!-- New Arrivals Section -->
            <div class="max-w-7xl mx-auto mb-20">
                <div class="text-center mb-12">
                    <div class="inline-block mb-4 px-5 py-2 bg-gradient-to-r from-amber-500/20 to-orange-500/20 border border-amber-500/30 text-amber-400 rounded-full text-sm font-bold">
                        ✨ NEW ARRIVALS
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-3">Latest Products</h2>
                    <p class="text-slate-300 text-lg">Check out our newest additions to the collection</p>
                </div>

                @php
                    $newArrivals = \App\Models\Product::with('category')
                        ->orderBy('created_at', 'desc')
                        ->take(8)
                        ->get();
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach($newArrivals as $product)
                        <div class="bg-white border border-blue-100 rounded-2xl shadow-lg hover:shadow-xl hover:border-blue-300 transition-all duration-300 overflow-hidden group hover:-translate-y-2">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    </div>
                                @endif
                                <!-- New Badge -->
                                <div class="absolute top-3 right-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    NEW
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-5">
                                <div class="text-xs text-blue-600 font-bold mb-1 uppercase tracking-wide">{{ $product->category->category_name ?? 'Uncategorized' }}</div>
                                <h3 class="font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors text-base">{{ $product->product_name }}</h3>
                                <p class="text-slate-700 text-sm mb-3 line-clamp-2 font-medium">{{ $product->description }}</p>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-blue-600">Rs.{{ number_format($product->price, 2) }}</span>
                                    </div>
                                    @if($product->stock_quantity > 0)
                                        <span class="text-xs text-green-600 font-semibold">✓ In Stock</span>
                                    @else
                                        <span class="text-xs text-red-600 font-semibold">Out of Stock</span>
                                    @endif
                                </div>

                                <a href="{{ route('products.index') }}" class="mt-4 w-full py-2.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    View Product
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-blue-50 border-2 border-blue-600 text-blue-600 font-bold rounded-full shadow-lg hover:shadow-xl transition-all">
                        View All Products
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Browse by Category Section -->
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold text-slate-900 mb-2">Browse by Category</h3>
                <p class="text-slate-700 text-lg font-medium">Shop products by your favorite categories</p>
            </div>

            <!-- Featured Categories -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-5xl mx-auto">
                @php
                    $categories = \App\Models\Category::orderBy('category_name')->get();
                    $categoryIcons = [
                        'Pens & Pencils' => '🖊️',
                        'Notebooks' => '📓',
                        'Planners' => '📅',
                        'Office Supplies' => '📎',
                        'Art Supplies' => '🎨',
                    ];
                @endphp
                
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-white border border-blue-100 hover:border-blue-400 rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer group">
                        <div class="text-4xl mb-3">{{ $categoryIcons[$category->category_name] ?? '📦' }}</div>
                        <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $category->category_name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/20 rounded-full blur-3xl opacity-40 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-40 h-40 bg-orange-500/20 rounded-full blur-3xl opacity-40 animate-pulse" style="animation-delay: 1s"></div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 bg-white border-y border-blue-100">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-slate-900 mb-16">Why Shop With Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-3xl hover:shadow-xl hover:border-blue-300 transition-all">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-4xl">🚀</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Fast Delivery</h3>
                    <p class="text-slate-700 leading-relaxed font-medium">Get your supplies delivered quickly to your doorstep. Free delivery on orders over Rs.2500!</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-100 rounded-3xl hover:shadow-xl hover:border-indigo-300 transition-all">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-4xl">✨</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Premium Quality</h3>
                    <p class="text-slate-700 leading-relaxed font-medium">Handpicked selection of high-quality products from trusted brands you love.</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-3xl hover:shadow-xl hover:border-blue-300 transition-all">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-4xl">💰</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Best Prices</h3>
                    <p class="text-slate-700 leading-relaxed font-medium">Competitive pricing on all products. Quality doesn't have to break the bank!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white relative overflow-hidden">
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Ready to Transform Your Workspace?</h2>
            <p class="text-blue-100 text-xl mb-10">Join thousands of happy customers who've upgraded their stationery game</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-white text-blue-600 text-lg font-bold rounded-full hover:shadow-2xl hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Browse Our Collection
            </a>
        </div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
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
                            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors flex items-center gap-2 font-semibold text-indigo-400">
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
</body>
</html>
