<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        \App\Services\SecurityAuditLogger::log('UNAUTHENTICATED_ACCESS_ATTEMPT', [
            'path' => $request->path(),
            'target_url' => $request->fullUrl(),
        ], 'warning');

        if ($request->is('lomba-ttg*')) {
            return route('peserta.login');
        }

        // Jika rute admin diakses tanpa login, jangan bocorkan URL rahasia login melainkan return 404
        if ($request->is('admin*')) {
            abort(404);
        }

        return route('login');
    }
}
