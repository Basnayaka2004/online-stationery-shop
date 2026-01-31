<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customer Dashboard') }}
            </h2>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('customer.logout') }}">
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
                <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
                <p>You are logged in as a customer.</p>

                <!-- Example Links -->
                <div class="mt-6 space-y-2">
                    <a href="#" class="text-blue-600 hover:underline">View Products</a><br>
                    <a href="#" class="text-blue-600 hover:underline">My Cart</a><br>
                    <a href="#" class="text-blue-600 hover:underline">My Orders</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
