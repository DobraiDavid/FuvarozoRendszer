<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Manual authentication because of custom password field
        $fuvarozo = \App\Models\Fuvarozo::where('email', $credentials['email'])->first();

        if ($fuvarozo && Hash::check($credentials['password'], $fuvarozo->jelszo)) {
            Auth::guard('fuvarozo')->login($fuvarozo, $request->filled('remember'));

            $request->session()->regenerate();

            // Redirect based on role
            if ($fuvarozo->id == 1 || str_contains($fuvarozo->email, 'admin')) {
                return redirect()->intended(route('admin.munkak.index'));
            }

            return redirect()->intended(route('fuvarozo.munkak.index'));
        }

        return back()->withErrors([
            'email' => 'A megadott adatok nem egyeznek.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('fuvarozo')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}