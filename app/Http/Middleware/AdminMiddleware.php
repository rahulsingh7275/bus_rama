<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'conductor')) {
            return $next($request);  // Proceed if the user is an admin
        }

        // Redirect or return a forbidden response if not an admin
        return redirect('/home');
    }
}
