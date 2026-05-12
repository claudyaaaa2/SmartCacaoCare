<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Jika user belum login, lempar ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Jika role user tidak sama dengan role yang diizinkan di route, beri error 403
        if (Auth::user()->role !== $role) {
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}