<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Online Stationery Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Top Navbar -->
<nav class="bg-indigo-600 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Stationery Shop - Admin</h1>
    <div class="flex items-center gap-4">
        <span class="text-sm">Admin</span>
        <button class="bg-indigo-800 px-3 py-1 rounded hover:bg-indigo-900">Logout</button>
    </div>
</nav>

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <ul class="py-6 space-y-2">
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100 font-medium">Dashboard</a>
            </li>
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100">Category</a>
            </li>
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100">Product</a>
            </li>
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100">Order</a>
            </li>
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100">Payment</a>
            </li>
            <li>
                <a href="#" class="block px-6 py-3 hover:bg-indigo-100">Customer</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Categories</h3>
                <p class="text-2xl font-bold">12</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Products</h3>
                <p class="text-2xl font-bold">48</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Orders</h3>
                <p class="text-2xl font-bold">35</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Customers</h3>
                <p class="text-2xl font-bold">27</p>
            </div>
        </div>

        <!-- Table Example -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold">Recent Orders</h2>
            </div>
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="p-3">#1001</td>
                        <td class="p-3">Kasun</td>
                        <td class="p-3">Rs. 3,500</td>
                        <td class="p-3 text-green-600">Paid</td>
                        <td class="p-3">
                            <button class="text-indigo-600 hover:underline">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>
