<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = $request->session()->get('user'); // Ambil peran user dari sesi

        if ($userRole !== $role) {
            return redirect('/'); // Redirect ke halaman utama jika tidak sesuai peran
        }

        return $next($request);
    }
}
