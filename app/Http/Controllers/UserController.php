<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('TurboParts.Admin.Settings', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_firstname' => 'required|string|max:50',
            'user_lastname' => 'required|string|max:50',
            'user_password' => 'required|string|min:8',
            'user_role' => 'required|in:admin,cashier,staff',
            'is_active' => 'sometimes|boolean',
        ]);

        User::create([
            'user_firstname' => $validated['user_firstname'],
            'user_lastname' => $validated['user_lastname'],
            'user_password' => Hash::make($validated['user_password']),
            'user_role' => $validated['user_role'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json(['success' => 'User created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
           'user_firstname' => 'required|string|max:50',
            'user_lastname' => 'required|string|max:50',
            'user_password' => 'nullable|string|min:8',
            'user_role' => 'required|in:admin,cashier,staff',
            'is_active' => 'required|boolean',
        ]);

        $updateData = [
            'user_firstname' => $validated['user_firstname'],
            'user_lastname' => $validated['user_lastname'],
            'user_role' => $validated['user_role'],
            'is_active' => $validated['is_active'],
        ];

        if(!empty($validated['user_password'])){
            $updateData['user_password'] = Hash::make($validated['user_password']);
        }

        $user->update($updateData);

        return response()->json(['success' => 'User update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => 'User deleted successfully']);
    }
}
