<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('session.index');
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
        // Requires all field to be filled
        $pField = $request->validate([
            "name"  => ["required"],
            "password"  => ["required"],
        ]);

        // Check for account with same username and password together
        if (auth()->attempt(['name' => $pField['name'], 'password' => $pField['password'] ])) {
            $request->session()->regenerate();
            return redirect()->route('crud')->with("success","Account successfully logged in.");
        }
        
        return redirect()->route('login')->with("error","Invalid username or password.");
        // return redirect("")->with("error","Invalid username or password.");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        auth()->logout();
        return redirect()->route('login');
    }
}
