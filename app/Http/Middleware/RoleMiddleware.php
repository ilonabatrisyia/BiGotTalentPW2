<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa baris ini!

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // 1. Cek apakah pengguna SUDAH LOGIN?
        // 2. Cek apakah ROLE pengguna SAMA DENGAN role yang diminta halaman?
        if (Auth::check() && Auth::user()->role === $role) {
            
            // Jika benar, persilakan masuk (lanjutkan perjalanan)
            return $next($request);
        }

        // Jika salah/tidak punya akses, munculkan halaman error 403 (Dilarang Masuk)
        return abort(403, 'Stop! Anda tidak memiliki hak akses ke halaman ini.');
    }
}
