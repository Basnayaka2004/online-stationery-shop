<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $user = Customer::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $username = \Illuminate\Support\Str::slug($request->name) . '_' . substr(uniqid(), -4);
        while (Customer::where('username', $username)->exists()) {
            $username = \Illuminate\Support\Str::slug($request->name) . '_' . substr(uniqid(), -4);
        }

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Return current authenticated customer (for API).
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Create API token for current user (for Axios from web).
     * Returns a fresh token; previous web_api tokens are revoked.
     */
    public function token(Request $request)
    {
        $customer = $request->user();
        $customer->tokens()->where('name', 'web_api')->delete();
        $token = $customer->createToken('web_api')->plainTextToken;
        return response()->json(['token' => $token]);
    }
}
