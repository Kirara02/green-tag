<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is set in session
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            // Set default locale based on browser language or config
            $locale = $request->getPreferredLanguage(['id', 'en']) ?? config('app.locale');
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        return $next($request);
    }
}
