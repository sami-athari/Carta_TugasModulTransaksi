<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userRole): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role === $userRole) {
                return $next($request);
            } else {
                return redirect('/')->with('error', 'Kamu tidak punya akses ke halaman ini.');
            }
        }
        

        return redirect('/login');
    }
}
