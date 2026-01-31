<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PaymentResource::collection(
            Payment::with(['customer', 'order'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'     => 'required|exists:customers,id',
            'cart_id'         => 'nullable|exists:carts,id',
            'order_id'        => 'required|exists:orders,id',
            'payment_method'  => 'required|string|max:50',
            'payment_amount'  => 'required|numeric|min:0',
            'payment_date'    => 'sometimes|date',
        ]);
        $data['payment_date'] = $data['payment_date'] ?? now();

        $payment = Payment::create($data);

        return new PaymentResource(
            $payment->load(['customer', 'order', 'cart'])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PaymentResource(
            Payment::with(['customer', 'order'])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);

        $data = $request->validate([
            'payment_method' => 'sometimes|string|max:50',
            'payment_amount' => 'sometimes|numeric|min:0',
            'payment_date'   => 'sometimes|date',
        ]);

        $payment->update($data);

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully'
        ], 200);
    }
}
