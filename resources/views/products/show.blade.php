@extends('layouts.shop')

@section('title', 'Product')

@section('content')
    <div class="max-w-2xl mx-auto" x-data="productShow({{ $id }})" x-init="load()">
        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline mb-4 inline-block">← Back to products</a>
        <div x-show="loading" class="text-gray-500">Loading...</div>
        <div x-show="error" class="rounded-lg bg-red-50 text-red-700 p-4" x-text="error"></div>
        <div x-show="!loading && !error && product" class="bg-white rounded-xl shadow-md p-6">
            <h1 class="text-2xl font-bold text-slate-900 mb-2" x-text="product.product_name"></h1>
            <p class="text-slate-600 mb-4" x-text="product.description || '—'"></p>
            <p class="text-indigo-600 font-bold text-xl mb-2">Rs.<span x-text="product.price ? parseFloat(product.price).toFixed(2) : '0.00'"></span></p>
            <p class="text-slate-500 text-sm mb-4">Stock: <span x-text="product.stock_quantity"></span></p>
            @auth
            <button type="button" @click="addToCart()" :disabled="!product || product.stock_quantity < 1" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 disabled:opacity-50">Add to cart</button>
            @else
            <a href="{{ route('login') }}" class="inline-block px-4 py-2 bg-slate-200 text-slate-600 font-medium rounded-lg">Log in to add to cart</a>
            @endauth
        </div>
    </div>
    <script>
    function productShow(id) {
        return {
            product: null,
            loading: true,
            error: '',
            id: id,
            get apiBase() { return window.APP_API_BASE || (window.APP_URL || '') + '/api'; },
            async load() {
                try {
                    const r = await fetch(this.apiBase + '/products/' + this.id, { headers: { 'Accept': 'application/json' } });
                    if (!r.ok) throw new Error('Product not found');
                    const data = await r.json();
                    this.product = data.data || data;
                } catch (e) { this.error = e.message; }
                this.loading = false;
            },
            async addToCart() {
                if (!this.product) return;
                try {
                    const tokenRes = await fetch('{{ route("api.token") }}', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
                    const { token } = await tokenRes.json();
                    const cartRes = await fetch(this.apiBase + '/my-cart', { credentials: 'same-origin', headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' } });
                    const cartData = await cartRes.json();
                    const cart = cartData.data || cartData;
                    await fetch(this.apiBase + '/cart-items', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify({ cart_id: cart.id, product_id: this.product.id, quantity: 1 })
                    });
                    alert('Added to cart');
                } catch (e) { alert(e.message || 'Failed'); }
            }
        };
    }
    </script>
@endsection
