<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_user')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder al panel.');
        }

        return $next($request);
    }
}
