<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $user = $request->session()->get('user');

        // dd($user);

        if (!$user) {
            return redirect('/login')->withErrors(['You do not have access to this section']);
        }

        if ($user['role_id'] === 1) {
            return $next($request);
        }

        return redirect()->back()->withErrors(['You do not have access to this section']);
    }
}