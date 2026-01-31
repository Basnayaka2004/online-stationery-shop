<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdminResource::collection(
            Admin::with(['products', 'categories'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'admin_name' => 'required',
            'email'      => 'required|email|unique:admins',
            'username'   => 'required|unique:admins',
            'password'   => 'required|min:6',
        ]);
        $data['password'] = Hash::make($data['password']);

        return new AdminResource(Admin::create($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new AdminResource(
            Admin::with(['products', 'categories'])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->validate([
            'admin_name' => 'sometimes',
            'email'      => 'sometimes|email|unique:admins,email,' . $admin->id,
            'username'   => 'sometimes|unique:admins,username,' . $admin->id,
            'password'   => 'sometimes|min:6',
        ]);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $admin->update($data);

        return new AdminResource($admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::findOrFail($id)->delete();
        return response()->json(['message' => 'Admin deleted']);
    }
    public function _construct()
    {
        $this->middleware('auth:admin');
    }

}

