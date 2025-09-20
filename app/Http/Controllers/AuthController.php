<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba lakukan autentikasi tanpa memeriksa role terlebih dahulu
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Setelah login berhasil, periksa role dan arahkan
            if ($user->role == 'admin') {
                return redirect()->intended(route('admin.dashboard.index'));
            }

            if ($user->role == 'officer') {
                return redirect()->intended(route('officer.dashboard.index'));
            }

            // Jika ada role lain yang tidak seharusnya login, logout saja
            Auth::logout();
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
