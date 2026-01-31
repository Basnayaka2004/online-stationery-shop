<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(
            Customer::with(['cart.cartItems.product', 'payments'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'phone'    => 'required|string|max:20',
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string|min:6',
            'street'   => 'required|string|max:255',
            'city'     => 'required|string|max:100',
            'state'    => 'required|string|max:100',
            'zip'      => 'required|string|max:20',
        ]);

        // Hash password before saving
        $data['password'] = Hash::make($data['password']);

        $customer = Customer::create($data);

        return new CustomerResource(
            $customer->load(['cart', 'payments'])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CustomerResource(
            Customer::with(['cart.cartItems.product', 'payments'])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $data = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:customers,email,' . $customer->id,
            'phone'    => 'sometimes|string|max:20',
            'username' => 'sometimes|string|unique:customers,username,' . $customer->id,
            'password' => 'sometimes|string|min:6',
            'street'   => 'sometimes|string|max:255',
            'city'     => 'sometimes|string|max:100',
            'state'    => 'sometimes|string|max:100',
            'zip'      => 'sometimes|string|max:20',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $customer->update($data);

        return new CustomerResource(
            $customer->load(['cart.cartItems.product', 'payments'])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully'
        ], 200);
    }

    public function _construct()
    {
        $this->middleware('auth:web');
    }
}
