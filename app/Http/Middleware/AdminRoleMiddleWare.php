<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleWare
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request); // agar admin hai to allow
        }

        return redirect('/login'); // agar admin nahi hai to login pe bhej do
    }
}
