<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureRoleIsKader
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = ['bidan', 'kader']; 

        if (!Auth::check() || !in_array(Auth::user()->role, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki akses');
        }

        return $next($request);
    }
}
