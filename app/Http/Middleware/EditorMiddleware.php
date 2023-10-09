<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna yang masuk memiliki level "Editor"
        if ($request->user() && $request->user()->level === 'Editor') {
            return $next($request);
        }

        // Jika bukan editor, mungkin Anda ingin mengarahkannya ke halaman lain atau memberikan pesan kesalahan
        abort(403, 'Unauthorized action.');
    }
}
