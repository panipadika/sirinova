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
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::random(40) . '.webp';
        $destinationDir = storage_path('app/public/' . trim($directory, '/'));

        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $fullPath = $destinationDir . '/' . $filename;

        try {
            $srcImage = null;

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $srcImage = @imagecreatefromjpeg($file->getRealPath());
                    break;
                case 'png':
                    $srcImage = @imagecreatefrompng($file->getRealPath());
                    break;
                case 'webp':
                    $srcImage = @imagecreatefromwebp($file->getRealPath());
                    break;
                case 'gif':
                    $srcImage = @imagecreatefromgif($file->getRealPath());
                    break;
            }

            if ($srcImage) {
                // Preserve transparency
                imagealphablending($srcImage, true);
                imagesavealpha($srcImage, true);

                // Convert & compress to WebP
                imagewebp($srcImage, $fullPath, $quality);
                imagedestroy($srcImage);

                return trim($directory, '/') . '/' . $filename;
            }
        } catch (\Throwable $e) {
            // Fallback if GD fails for any reason
        }

        // Fallback to standard Laravel file store
        return $file->store($directory, 'public');
    }
}
