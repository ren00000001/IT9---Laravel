<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'password' => 'required|string',
            'user_role' => 'required|in:admin,cashier,staff',
        ]);


        $user = User::where('user_firstname', $credentials['firstname'])
                        ->where('user_lastname', $credentials['lastname'])
                        ->where('user_role', $credentials['user_role'])
                        ->first();
                        
               if(!$user || !password_verify($credentials['password'], $user->user_password)){
                    return back()->withErrors([
                        'login_error' => 'Invalid credentials or role mismatched',
                    ])->withInput($request->except('password'));

               }

        Auth::login($user);
        $request->session()->regenerate();

        switch($user->user_role){
            case 'cashier':
                return redirect()->route('cashier.pos');
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'staff':
                return redirect()->route('staff.products');
            default: 
                Auth::logout();
                return redirect('login')->withErrors([
                    'login_error' => 'Invalid user role'
                ]);
        }       

    }
    

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/');

    }

}
