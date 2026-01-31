<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Http\Resources\CartItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartItemResource::collection(
            CartItem::with(['product', 'cart'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart_id'    => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        // If product already exists in cart → update quantity
        $cartItem = CartItem::where('cart_id', $data['cart_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $data['quantity'];
            $cartItem->save();
        } else {
            $cartItem = CartItem::create($data);
        }

        return new CartItemResource(
            $cartItem->load('product')
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CartItemResource(
            CartItem::with(['product', 'cart'])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $cartItem->update($data);

        return new CartItemResource(
            $cartItem->load('product')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json([
            'message' => 'Cart item removed successfully'
        ], 200);
    }
}
