<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * List orders for the authenticated customer (for Axios / frontend).
     */
    public function myOrders(Request $request)
    {
        $customer = $request->user();
        $orders = Order::with(['customer', 'orderItems', 'payment'])
            ->where('customer_id', $customer->id)
            ->orderByDesc('order_date')
            ->get();
        return OrderResource::collection($orders);
    }

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

        $cart = Cart::with('cartItems.product')->findOrFail($data['cart_id']);
        if ($cart->customer_id != $data['customer_id']) {
            return response()->json(['message' => 'Cart does not belong to customer'], 403);
        }

        $order = Order::create($data);

        foreach ($cart->cartItems as $cartItem) {
            OrderItem::create([
                'order_id'          => $order->id,
                'cart_item_id'      => $cartItem->id,
                'product_id'        => $cartItem->product_id,
                'quantity'          => $cartItem->quantity,
                'price_at_purchase' => $cartItem->product ? $cartItem->product->price : 0,
            ]);
        }

        // Clear cart after successful order
        $cart->cartItems()->delete();

        return new OrderResource(
            $order->load(['customer', 'orderItems.cartItem.product'])
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
                'orderItems.cartItem.product',
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

     public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }
}
