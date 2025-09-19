<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Jika ya, lanjutkan request
        }

        // Jika tidak login atau bukan admin, redirect ke halaman login
        return redirect()->route('login');
    }
}


