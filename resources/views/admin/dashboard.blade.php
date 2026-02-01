@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Welcome, {{ Auth::guard('admin')->user()->admin_name }}!</h1>
        <p class="text-slate-600 mt-1">Manage your online stationery shop</p>
    </div>

    @livewire('admin.dashboard-stats')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <a href="{{ route('admin.products.index') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-indigo-600">
            <div class="text-4xl mb-2">📦</div>
            <h3 class="text-lg font-semibold text-slate-900">Manage Products</h3>
            <p class="text-slate-600 text-sm mt-1">Add, edit, or remove products</p>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-purple-600">
            <div class="text-4xl mb-2">📁</div>
            <h3 class="text-lg font-semibold text-slate-900">Manage Categories</h3>
            <p class="text-slate-600 text-sm mt-1">Organize product categories</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border-l-4 border-green-600">
            <div class="text-4xl mb-2">🛒</div>
            <h3 class="text-lg font-semibold text-slate-900">View Orders</h3>
            <p class="text-slate-600 text-sm mt-1">Customer orders and status</p>
        </a>
    </div>
@endsection
