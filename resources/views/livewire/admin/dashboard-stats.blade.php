<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-medium">Total Products</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalProducts }}</p>
            </div>
            <div class="bg-indigo-100 rounded-full p-3">
                <span class="text-2xl">📦</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-medium">Categories</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalCategories }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <span class="text-2xl">📁</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-medium">Total Orders</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <span class="text-2xl">🛒</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-600 text-sm font-medium">Customers</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalCustomers }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <span class="text-2xl">👥</span>
            </div>
        </div>
    </div>
</div>
