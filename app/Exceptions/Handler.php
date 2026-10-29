<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Pastikan permintaan API / JSON selalu mengembalikan pesan generik yang bersih
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Halaman atau sumber daya tidak ditemukan.'
                ], 404);
            }
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Metode HTTP tidak diizinkan.'
                ], 405);
            }
        });

        // Tangani jika file / payload yang diunggah melebihi post_max_size server (Error 413)
        $this->renderable(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ukuran file atau data yang diunggah terlalu besar melebihi batas server.'
                ], 413);
            }

            return back()->withInput()->with('error', 'Ukuran foto/file yang Anda unggah terlalu besar dan melebihi batas upload server. Silakan gunakan foto dengan ukuran lebih kecil (disarankan di bawah 2MB).');
        });
    }
}
