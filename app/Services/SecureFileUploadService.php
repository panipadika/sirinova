<?php

namespace App\Services;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SecureFileUploadService
{
    /**
     * Daftar ekstensi berbahaya yang dilarang keras diunggah
     */
    protected static array $prohibitedExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml', 'phar', 'exe', 'sh', 'bash',
        'bat', 'cmd', 'cgi', 'pl', 'py', 'js', 'jsp', 'asp', 'aspx', 'vbs',
        'ps1', 'jar', 'svg', 'htaccess', 'ini', 'sh'
    ];

    /**
     * Validasi dan simpan file gambar secara aman dengan server-side validation & nama acak UUID.
     *
     * @param UploadedFile $file
     * @param string $directory Direktori penyimpanan (misal: 'foto_lomba')
     * @param string $disk Disk penyimpanan (misal: 'public')
     * @param int $maxKilobytes Ukuran maksimal dalam KB (default 5120 = 5MB)
     * @return string Path relatif file yang tersimpan
     * @throws ValidationException
     */
    public static function validateAndStoreImage(
        UploadedFile $file,
        string $directory = 'foto_lomba',
        string $disk = 'public',
        int $maxKilobytes = 5120
    ): string {
        $fieldName = 'foto_alat';

        // 1. Validasi keberadaan dan status upload
        if (!$file->isValid()) {
            SecurityAuditLogger::log('FILE_UPLOAD_INVALID', [
                'field' => $fieldName,
                'error' => $file->getErrorMessage(),
            ], 'error');
            throw ValidationException::withMessages([
                $fieldName => 'File yang diunggah rusak atau gagal diproses oleh server.',
            ]);
        }

        // 2. Validasi ukuran file
        $fileSizeBytes = $file->getSize();
        if ($fileSizeBytes > ($maxKilobytes * 1024)) {
            throw ValidationException::withMessages([
                $fieldName => "Ukuran foto melebihi batas maksimal ({$maxKilobytes} KB / 5 MB).",
            ]);
        }

        // 3. Validasi ekstensi original (Anti-Double Extension / Malicious Scripts)
        $originalName = $file->getClientOriginalName();
        $clientExt = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($clientExt, $allowedExtensions, true)) {
            SecurityAuditLogger::log('MALICIOUS_FILE_UPLOAD_BLOCKED', [
                'reason' => 'Invalid file extension',
                'original_name' => $originalName,
                'client_extension' => $clientExt,
            ], 'critical');
            throw ValidationException::withMessages([
                $fieldName => 'Format file tidak didukung. Hanya gambar JPG, JPEG, PNG, atau WEBP yang diperbolehkan.',
            ]);
        }

        // Cek apakah ada ekstensi skrip yang disisipkan (e.g., shell.php.jpg)
        foreach (self::$prohibitedExtensions as $badExt) {
            if (preg_match('/\.' . preg_quote($badExt, '/') . '(\.|$)/i', $originalName)) {
                SecurityAuditLogger::log('MALICIOUS_FILE_UPLOAD_BLOCKED', [
                    'reason' => 'Prohibited script extension detected in filename',
                    'original_name' => $originalName,
                    'detected_bad_extension' => $badExt,
                ], 'critical');
                throw ValidationException::withMessages([
                    $fieldName => 'Nama file mengandung ekstensi atau karakter berbahaya yang tidak diizinkan.',
                ]);
            }
        }

        // 4. Validasi MIME Type di sisi server menggunakan finfo (MIME Sniffing Prevention)
        $filePath = $file->getPathname() ?: (string) $file->getRealPath();
        $serverMime = null;
        if (!empty($filePath) && file_exists($filePath) && function_exists('finfo_open')) {
            $finfo = @finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo) {
                $serverMime = @finfo_file($finfo, $filePath);
                @finfo_close($finfo);
            }
        }
        if (!$serverMime) {
            $serverMime = $file->getMimeType();
        }

        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($serverMime, $allowedMimes, true)) {
            SecurityAuditLogger::log('MALICIOUS_FILE_UPLOAD_BLOCKED', [
                'reason' => 'MIME type mismatch or forged',
                'original_name' => $originalName,
                'detected_mime' => $serverMime,
            ], 'critical');
            throw ValidationException::withMessages([
                $fieldName => 'Konten berkas tidak valid atau tidak sesuai dengan format gambar yang diperbolehkan.',
            ]);
        }

        // 5. Validasi Integritas Gambar Nyata (Pastikan bukan fake image / polyglot payload)
        $imageInfo = !empty($filePath) && file_exists($filePath) ? @getimagesize($filePath) : false;
        if ($imageInfo === false || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP], true)) {
            SecurityAuditLogger::log('MALICIOUS_FILE_UPLOAD_BLOCKED', [
                'reason' => 'Corrupt or fake image structure',
                'original_name' => $originalName,
            ], 'critical');
            throw ValidationException::withMessages([
                $fieldName => 'File yang diunggah bukan gambar asli atau struktur berkas rusak.',
            ]);
        }

        // 6. Deep Content Inspection: Cegah payload PHP / script tersembunyi dalam gambar
        $contentsSample = (!empty($filePath) && file_exists($filePath)) ? @file_get_contents($filePath, false, null, 0, 4096) : '';
        if (preg_match('/(<\?php|<\?=|<script|eval\s*\(|base64_decode)/i', $contentsSample)) {
            SecurityAuditLogger::log('MALICIOUS_FILE_UPLOAD_BLOCKED', [
                'reason' => 'Embedded executable script payload detected in image content',
                'original_name' => $originalName,
            ], 'critical');
            throw ValidationException::withMessages([
                $fieldName => 'File ditolak karena terdeteksi mengandung konten skrip yang tidak aman.',
            ]);
        }

        // 7. Simpan dengan Nama Acak Berbasis UUID (Mencegah Path Traversal & File Overwrite)
        $canonicalExt = ($clientExt === 'jpeg') ? 'jpg' : $clientExt;
        $safeFilename = (string) Str::uuid() . '.' . $canonicalExt;

        /** @var FilesystemAdapter $storageDisk */
        $storageDisk = Storage::disk($disk);
        $storedPath = $storageDisk->putFileAs($directory, $file, $safeFilename);

        SecurityAuditLogger::log('FILE_UPLOAD_SUCCESS', [
            'directory' => $directory,
            'disk' => $disk,
            'filename' => $safeFilename,
            'mime' => $serverMime,
            'size_bytes' => $fileSizeBytes,
        ], 'info');

        return $storedPath;
    }

    /**
     * Validasi dan simpan file dokumen proposal peserta ke PRIVATE STORAGE (disk: local).
     * Dokumen proposal bersifat rahasia/sensitif dan diisolasi penuh dari akses publik langsung.
     *
     * @param UploadedFile $file
     * @param int $maxKilobytes Maksimal ukuran file dalam KB (default 10240 = 10MB)
     * @return string Path relatif file yang tersimpan pada private storage (e.g. proposals/{uuid}.pdf)
     * @throws ValidationException
     */
    public static function validateAndStoreProposalDocument(
        UploadedFile $file,
        int $maxKilobytes = 10240
    ): string {
        $fieldName = 'file_proposal';

        // 1. Validasi keberadaan file
        if (!$file->isValid()) {
            SecurityAuditLogger::log('PROPOSAL_UPLOAD_INVALID', [
                'error' => $file->getErrorMessage(),
            ], 'error');
            throw ValidationException::withMessages([
                $fieldName => 'File proposal yang diunggah rusak atau gagal diproses server.',
            ]);
        }

        // 2. Validasi ukuran (Maksimal 10 MB)
        $fileSizeBytes = $file->getSize();
        if ($fileSizeBytes > ($maxKilobytes * 1024)) {
            throw ValidationException::withMessages([
                $fieldName => "Ukuran file proposal melebihi batas maksimal ({$maxKilobytes} KB / 10 MB).",
            ]);
        }

        // 3. Validasi ekstensi
        $originalName = $file->getClientOriginalName();
        $clientExt = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = ['pdf', 'doc', 'docx'];

        if (!in_array($clientExt, $allowedExtensions, true)) {
            SecurityAuditLogger::log('MALICIOUS_PROPOSAL_UPLOAD_BLOCKED', [
                'reason' => 'Invalid proposal extension',
                'original_name' => $originalName,
                'client_extension' => $clientExt,
            ], 'warning');
            throw ValidationException::withMessages([
                $fieldName => 'Dokumen proposal harus berformat PDF, DOC, atau DOCX.',
            ]);
        }

        // Cegah skrip berbahaya
        foreach (self::$prohibitedExtensions as $badExt) {
            if (preg_match('/\.' . preg_quote($badExt, '/') . '(\.|$)/i', $originalName)) {
                SecurityAuditLogger::log('MALICIOUS_PROPOSAL_UPLOAD_BLOCKED', [
                    'reason' => 'Prohibited script extension in proposal filename',
                    'original_name' => $originalName,
                ], 'critical');
                throw ValidationException::withMessages([
                    $fieldName => 'Nama file dokumen proposal mengandung karakter atau ekstensi berbahaya.',
                ]);
            }
        }

        // 4. Validasi Server-Side MIME Type
        $filePath = $file->getPathname() ?: (string) $file->getRealPath();
        $serverMime = null;
        if (!empty($filePath) && file_exists($filePath) && function_exists('finfo_open')) {
            $finfo = @finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo) {
                $serverMime = @finfo_file($finfo, $filePath);
                @finfo_close($finfo);
            }
        }
        if (!$serverMime) {
            $serverMime = $file->getMimeType();
        }

        $allowedMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/zip', // docx sering terdeteksi zip oleh libmagic
        ];

        if (!in_array($serverMime, $allowedMimes, true)) {
            SecurityAuditLogger::log('MALICIOUS_PROPOSAL_UPLOAD_BLOCKED', [
                'reason' => 'Proposal MIME mismatch',
                'original_name' => $originalName,
                'detected_mime' => $serverMime,
            ], 'warning');
            throw ValidationException::withMessages([
                $fieldName => 'Berkas yang diunggah tidak sesuai dengan tipe dokumen proposal yang valid.',
            ]);
        }

        // 5. Validasi Magic Bytes untuk PDF
        if ($clientExt === 'pdf') {
            $header = (!empty($filePath) && file_exists($filePath)) ? @file_get_contents($filePath, false, null, 0, 5) : '';
            if (!str_starts_with($header, '%PDF-')) {
                SecurityAuditLogger::log('MALICIOUS_PROPOSAL_UPLOAD_BLOCKED', [
                    'reason' => 'Invalid PDF header magic bytes',
                    'original_name' => $originalName,
                ], 'critical');
                throw ValidationException::withMessages([
                    $fieldName => 'Berkas PDF tidak valid atau struktur dokumen rusak.',
                ]);
            }
        }

        // 6. Simpan ke PRIVATE STORAGE (disk: local) dengan UUID
        $safeFilename = (string) Str::uuid() . '.' . $clientExt;

        /** @var FilesystemAdapter $privateStorageDisk */
        $privateStorageDisk = Storage::disk('local');
        $privatePath = $privateStorageDisk->putFileAs('proposals', $file, $safeFilename);

        SecurityAuditLogger::log('PROPOSAL_FILE_STORED_SECURELY', [
            'storage_disk' => 'local (private)',
            'path' => $privatePath,
            'size_bytes' => $fileSizeBytes,
        ], 'info');

        return $privatePath;
    }
}
