<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-button class="bg-red-500 hover:bg-red-600">
                    {{ __('Logout') }}
                </x-button>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::guard('admin')->user()->admin_name }}!</h1>
                <p>You are logged in as an admin.</p>

                <!-- Example Links -->
                <div class="mt-6 space-y-2">
                    <a href="#" class="text-blue-600 hover:underline">Manage Products</a><br>
                    <a href="#" class="text-blue-600 hover:underline">Manage Categories</a><br>
                    <a href="#" class="text-blue-600 hover:underline">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
