<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function show()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

    //     User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']), // important!
    //     ]);

    //     // After signup, go to login (no auto-login, no autofill)
    //     return redirect()->route('login')->with('status', 'Account created. Please log in.');
    // }

    // Create the user and keep a reference to log them in
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Log the new user in
    \Illuminate\Support\Facades\Auth::login($user);

    return redirect()->route('dashboard');
}
}
