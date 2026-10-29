<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Compress and convert uploaded image to optimized WebP format.
     *
     * @param UploadedFile $file
     * @param string $directory (e.g. 'alat_ttg', 'ebooks/covers', 'galeri/photos')
     * @param int $quality (compression quality 1-100, default 80)
     * @return string relative path stored inside storage/app/public
     */
    public static function convertToWebp(UploadedFile $file, string $directory, int $quality = 80): string
    {
        $directory = trim($directory, '/');

        try {
            // Cek apakah ekstensi GD dan fungsi image WebP tersedia
            if (extension_loaded('gd') && function_exists('imagewebp')) {
                $extension = strtolower($file->getClientOriginalExtension());
                $srcImage = null;

                switch ($extension) {
                    case 'jpeg':
                    case 'jpg':
                        if (function_exists('imagecreatefromjpeg')) {
                            $srcImage = @imagecreatefromjpeg($file->getRealPath());
                        }
                        break;
                    case 'png':
                        if (function_exists('imagecreatefrompng')) {
                            $srcImage = @imagecreatefrompng($file->getRealPath());
                        }
                        break;
                    case 'webp':
                        if (function_exists('imagecreatefromwebp')) {
                            $srcImage = @imagecreatefromwebp($file->getRealPath());
                        }
                        break;
                    case 'gif':
                        if (function_exists('imagecreatefromgif')) {
                            $srcImage = @imagecreatefromgif($file->getRealPath());
                        }
                        break;
                }

                if ($srcImage) {
                    // Pertahankan transparansi PNG / WebP
                    imagealphablending($srcImage, true);
                    imagesavealpha($srcImage, true);

                    // Konversi ke WebP dalam memory buffer (tanpa raw filesystem mkdir)
                    ob_start();
                    $success = @imagewebp($srcImage, null, $quality);
                    $webpData = ob_get_clean();

                    if (function_exists('imagedestroy')) {
                        @imagedestroy($srcImage);
                    }

                    if ($success && !empty($webpData)) {
                        $filename = Str::random(40) . '.webp';
                        $relativePath = $directory . '/' . $filename;

                        // Simpan menggunakan disk public Laravel (otomatis membuat direktori dengan izin yang benar)
                        Storage::disk('public')->put($relativePath, $webpData);

                        // Sinkronkan juga ke storage/app/public jika path public berbeda
                        try {
                            if (is_dir(base_path('../public_html/storage')) && is_dir(storage_path('app/public'))) {
                                @file_put_contents(storage_path('app/public/' . $relativePath), $webpData);
                            }
                        } catch (\Throwable $e) {
                            // Abaikan jika folder lokal tidak ada
                        }

                        return $relativePath;
                    }
                }
            }
        } catch (\Throwable $e) {
            // Jika ada kendala pada GD, lanjut ke fallback standar Laravel
        }

        // Fallback resmi dan aman Laravel
        return $file->store($directory, 'public');
    }
}
