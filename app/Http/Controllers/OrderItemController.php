<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderItemResource::collection(
            OrderItem::with([
                'order',
                'cartItem.product'
            ])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id'          => 'required|exists:orders,id',
            'cart_item_id'      => 'required|exists:cart_items,id',
            'quantity'          => 'required|integer|min:1',
            'price_at_purchase' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::create($data);

        return new OrderItemResource(
            $orderItem->load('cartItem.product')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new OrderItemResource(
            OrderItem::with([
                'order',
                'cartItem.product'
            ])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $data = $request->validate([
            'quantity'          => 'required|integer|min:1',
            'price_at_purchase' => 'required|numeric|min:0',
        ]);

        $orderItem->update($data);

        return new OrderItemResource($orderItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return response()->json([
            'message' => 'Order item deleted successfully'
        ], 200);
    }
}
