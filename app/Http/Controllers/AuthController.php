<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

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

        // Fires event for registering email
        event(new Registered($user));

        // Redirect to dashboard
        return redirect('/dashboard');
    }

    // Verify Email Notice handler
    public function verifyNotice() {
        return view('auth.verify-email');
    }

    // Email Verification Handler
    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    // Resending the Verification Email
    public function verifyHandler(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verificatielink verzonden!');
    }

    public function loginUser(Request $request) {
        // Validate
        $fields = $request->validate([
            'email' => ['required', 'max:255','email'],
            'password' => ['required']
        ]);

        // Try to login the user
        if (Auth::attempt($fields, $request->remember)) {
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
