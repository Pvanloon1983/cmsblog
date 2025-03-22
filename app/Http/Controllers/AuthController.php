<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function registerUser(Request $request) {
        // Validate
        $fields = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'max:255', 'min:8', 'confirmed'],
        ]);

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // Redirect to dashboard
        return redirect('/dashboard');
    }

    public function loginUser(Request $request) {
        // Validate
        $fields = $request->validate([
            'email' => ['required', 'max:255','email'],
            'password' => ['required']
        ]);

        // Try to login the user
        if (Auth::attempt($fields)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'Gebruikersnaam of wachtwoord is onjuist.',
            ]);
        }
    }

    public function logout(Request $request) {
        // Logout user
        Auth::logout();

        // Invalidate user's session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to home
        return redirect('/');
    }
}
