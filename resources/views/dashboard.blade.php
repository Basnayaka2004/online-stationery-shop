<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section with Gradient -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 rounded-3xl shadow-2xl p-10 mb-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
                        Welcome back, {{ Auth::user()->name }}! 🎉
                    </h1>
                    <p class="text-xl text-blue-100 mb-6">
                        Ready to shop for amazing stationery products?
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-600 font-bold rounded-full hover:shadow-2xl hover:scale-105 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Start Shopping
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Products Available -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-600 hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-700 text-sm font-bold mb-1 uppercase tracking-wide">Products Available</p>
                            <p class="text-4xl font-bold text-slate-900">{{ \App\Models\Product::count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center">
                            <span class="text-3xl">📦</span>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-indigo-600 hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-700 text-sm font-bold mb-1 uppercase tracking-wide">Categories</p>
                            <p class="text-4xl font-bold text-slate-900">{{ \App\Models\Category::count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center">
                            <span class="text-3xl">📁</span>
                        </div>
                    </div>
                </div>

                <!-- My Orders -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-600 hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-700 text-sm font-bold mb-1 uppercase tracking-wide">My Orders</p>
                            <p class="text-4xl font-bold text-slate-900">{{ \App\Models\Order::where('customer_id', Auth::user()->id)->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center">
                            <span class="text-3xl">📋</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Shop Card -->
                <a href="{{ route('products.index') }}" class="group bg-gradient-to-br from-blue-600 to-indigo-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-4xl">🛍️</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Browse Shop</h3>
                        <p class="text-blue-100 mb-4">Explore our collection of premium stationery products</p>
                        <div class="flex items-center gap-2 font-semibold">
                            <span>Shop Now</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </div>
                </a>

                <!-- Cart Card -->
                <a href="{{ route('cart.index') }}" class="group bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-4xl">🛒</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">My Cart</h3>
                        <p class="text-indigo-100 mb-4">View and manage items in your shopping cart</p>
                        <div class="flex items-center gap-2 font-semibold">
                            <span>View Cart</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </div>
                </a>

                <!-- Orders Card -->
                <a href="{{ route('orders.index') }}" class="group bg-gradient-to-br from-blue-600 to-indigo-600 rounded-3xl shadow-xl p-8 hover:shadow-2xl hover:scale-105 transition-all text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-4xl">📦</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">My Orders</h3>
                        <p class="text-blue-100 mb-4">Track your orders and view order history</p>
                        <div class="flex items-center gap-2 font-semibold">
                            <span>View Orders</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Activity / Tips -->
            <div class="mt-8 bg-white rounded-3xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white">💡</span>
                    Shopping Tips
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            🚚
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Free Delivery</h4>
                            <p class="text-slate-700 text-sm font-medium">Get free delivery on all orders over Rs.2500!</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl">
                        <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            ⭐
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Premium Quality</h4>
                            <p class="text-slate-700 text-sm font-medium">All products are handpicked for quality and durability.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            💰
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Best Prices</h4>
                            <p class="text-slate-700 text-sm font-medium">Competitive pricing on all your favorite stationery items.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl">
                        <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            🔒
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Secure Checkout</h4>
                            <p class="text-slate-700 text-sm font-medium">Your payment information is always safe and secure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
