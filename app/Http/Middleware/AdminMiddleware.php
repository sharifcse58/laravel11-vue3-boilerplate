<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the 'admin' role
        if (auth()->check() && auth()->user()->role->name === 'admin') {
            return $next($request); // Allow the request to continue if the user is an admin
        }

        // If not an admin, redirect them or show a forbidden error
        return redirect()->route('dashboard'); // You can redirect to the home page or any other route
    }
}
