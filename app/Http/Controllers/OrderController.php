<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(
            Order::with([
                'customer',
                'orderItems.cartItem.product',
                'payment'
            ])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart_id'     => 'required|exists:carts,id',
            'customer_id' => 'required|exists:customers,id',
            'order_date'  => 'required|date',
            'status'      => 'required|string|max:50',
        ]);
        $order = Order::create($data);

        return new OrderResource(
            $order->load(['customer'])
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new OrderResource(
            Order::with([
                'customer',
                'orderItem.cartItem.product',
                'payment'
            ])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|string|max:50'
        ]);

        $order->update($data);

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
