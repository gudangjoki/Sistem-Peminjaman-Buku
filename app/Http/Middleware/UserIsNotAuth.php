<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class UserIsNotAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('UserIsNotAuth middleware invoked');

        // Check if the user is authenticated
        if (Auth::check()) {
            Log::info('User is authenticated, redirecting...');
            // Redirect to home with an error message
            return redirect()->back()->withErrors(['You are already logged in']);
        }

        Log::info('User is not authenticated, proceeding...');
        // Proceed with the request if the user is not authenticated
        return $next($request);
    }
}
