<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-slate-900 to-slate-800 min-h-screen text-white">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold">Admin Panel</h2>
                <p class="text-slate-400 text-sm mt-1">{{ Auth::guard('admin')->user()->admin_name }}</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-slate-700' }} transition">
                    <span class="font-medium">📊 Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600' : 'hover:bg-slate-700' }} transition">
                    <span class="font-medium">📦 Products</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600' : 'hover:bg-slate-700' }} transition">
                    <span class="font-medium">📁 Categories</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600' : 'hover:bg-slate-700' }} transition">
                    <span class="font-medium">🛒 Orders</span>
                </a>
                <hr class="border-slate-700 my-4">
                <a href="{{ url('/') }}" class="block px-4 py-3 rounded-lg hover:bg-slate-700 transition" target="_blank">
                    <span class="font-medium">🏪 View Shop</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition font-medium">
                        🚪 Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
