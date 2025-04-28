<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        /*$credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);*/
        
        $userRole = $request->input('user_role');

        switch($userRole){
            case 'cashier':
                return redirect()->route('cashier.pos');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default: 
                return redirect('login');
        }

        /*if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            switch($userRole){
                case 'cashier':
                    return redirect()->route('TurboParts.Cashier.Dashboard');
                case 'admin':
                    return redirect()->route('TurboParts.Admin.Dasboard');
            }
        }*/

        /*return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));*/

       

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/');

    }

}
