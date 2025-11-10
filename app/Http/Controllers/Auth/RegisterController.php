<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Fuvarozo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:fuvarozo',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $fuvarozo = Fuvarozo::create([
            'nev' => $validated['nev'],
            'email' => $validated['email'],
            'jelszo' => Hash::make($validated['password']),
        ]);

        Auth::guard('fuvarozo')->login($fuvarozo);

        return redirect()->route('fuvarozo.munkak.index')
            ->with('success', 'Sikeres regisztráció! Üdvözlünk a rendszerben.');
    }
}