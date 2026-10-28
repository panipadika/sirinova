<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hapus header X-Powered-By dari level PHP runtime
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }

        $response = $next($request);

        // Hapus header X-Powered-By dari response header Symfony / Laravel
        $response->headers->remove('X-Powered-By');

        // Penguatan header keamanan tambahan (Defensive Headers)
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
