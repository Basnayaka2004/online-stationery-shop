<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) – Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 font-sans antialiased">
    <header class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">{{ config('app.name') }}</a>
                <nav class="flex items-center gap-4">
                    <a href="{{ route('products.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Shop</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Dashboard</a>
                        <a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Cart</a>
                        <a href="{{ route('orders.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Orders</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="text-slate-600 hover:text-red-600 font-medium">Logout</button></form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700">Register</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
