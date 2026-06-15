<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
 public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, atau role user tidak ada di dalam daftar role yang diizinkan
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            // Lempar error 403 (Forbidden / Akses Ditolak)
            abort(403, 'Maaf, akun Anda tidak memiliki hak akses untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
