<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna yang masuk memiliki level "Admin"
        if ($request->user() && $request->user()->level === 'Admin') {
            return $next($request);
        }

        // Jika bukan admin, mungkin Anda ingin mengarahkannya ke halaman lain atau memberikan pesan kesalahan
        abort(403, 'Unauthorized action.');
    }
}
