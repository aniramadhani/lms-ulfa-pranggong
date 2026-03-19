<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah role user saat ini SESUAI dengan role yang diizinkan
        if ($request->user()->role !== $role) {
            // Kalau nggak sesuai, lempar ke halaman Error 403 (Akses Ditolak)
            abort(403, 'Akses Ditolak! Anda bukan ' . $role);
        }

        return $next($request);
    }
}