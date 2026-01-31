<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    // Show the customer login form
    public function create()
    {
        return view('auth.customer-login'); // Blade view for customer login
    }

    // Handle login form submission
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Use the 'web' guard (customer login)
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->route('customer.dashboard'); // redirect to customer dashboard
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout(); // logout from customer guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // redirect to customer login page
    }
}
