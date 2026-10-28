<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SecurityAuditLogger
{
    /**
     * Catat kejadian keamanan penting secara terstruktur ke security audit log.
     * Otomatis melakukan sanitasi dan sensor (redaction) pada seluruh data sensitif.
     *
     * @param string $event Nama event keamanan (e.g. AUTH_LOGIN_FAILED, IDOR_ATTEMPT)
     * @param array $context Data konteks kejadian
     * @param string $level Tingkat log (info, warning, error, critical)
     */
    public static function log(string $event, array $context = [], string $level = 'warning'): void
    {
        $sanitizedContext = self::sanitize($context);

        $currentUser = Auth::guard('web')->user() ?? Auth::guard('peserta')->user();
        $guard = Auth::guard('web')->check() ? 'web' : (Auth::guard('peserta')->check() ? 'peserta' : 'guest');

        $record = [
            'timestamp'   => now()->toIso8601String(),
            'event'       => $event,
            'actor_guard' => $guard,
            'actor_id'    => $currentUser ? $currentUser->id : null,
            'ip'          => request()->ip() ?? 'CLI/UNKNOWN',
            'user_agent'  => request()->userAgent() ?? 'CLI/UNKNOWN',
            'url'         => request()->fullUrl(),
            'method'      => request()->method(),
            'context'     => $sanitizedContext,
        ];

        try {
            Log::channel('security')->log($level, "SECURITY_AUDIT: {$event}", $record);
        } catch (\Throwable $e) {
            // Fallback ke default channel
            Log::log($level, "SECURITY_AUDIT: {$event}", $record);
        }
    }

    /**
     * Sensor (redact) seluruh informasi rahasia atau sensitif seperti password,
     * token, cookie sesi, authorization header, serta masking PII (email & nomor HP).
     *
     * @param mixed $data
     * @return mixed
     */
    public static function sanitize(mixed $data): mixed
    {
        if (!is_array($data)) {
            return $data;
        }

        $sensitiveKeyPatterns = [
            'password', 'kata_sandi', 'pass', 'secret', 'token', 'remember_token',
            '_token', 'cookie', 'session', 'authorization', 'bearer', 'csrf', 'api_key'
        ];

        $sanitized = [];

        foreach ($data as $key => $value) {
            $lowerKey = strtolower((string)$key);

            // Cek apakah key merupakan informasi rahasia
            if (Str::contains($lowerKey, $sensitiveKeyPatterns)) {
                $sanitized[$key] = '[REDACTED]';
                continue;
            }

            // Jika berupa array, bersihkan secara rekursif
            if (is_array($value)) {
                $sanitized[$key] = self::sanitize($value);
                continue;
            }

            // Masking data PII: Email
            if ($lowerKey === 'email' && is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $sanitized[$key] = self::maskEmail($value);
                continue;
            }

            // Masking data PII: Nomor Telepon / WhatsApp
            if (in_array($lowerKey, ['no_wa', 'telepon', 'phone', 'nomor_wa']) && is_string($value)) {
                $sanitized[$key] = self::maskPhone($value);
                continue;
            }

            $sanitized[$key] = $value;
        }

        return $sanitized;
    }

    /**
     * Masking alamat email (misal: "admin@tasikmalayakota.go.id" -> "ad***@tasikmalayakota.go.id").
     */
    public static function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return '[REDACTED_EMAIL]';
        }
        $name = $parts[0];
        $domain = $parts[1];
        $maskedName = strlen($name) <= 2 ? substr($name, 0, 1) . '***' : substr($name, 0, 2) . '***';
        return $maskedName . '@' . $domain;
    }

    /**
     * Masking nomor telepon/WA (misal: "081234567890" -> "0812****7890").
     */
    public static function maskPhone(string $phone): string
    {
        $len = strlen($phone);
        if ($len <= 4) {
            return '****';
        }
        return substr($phone, 0, 4) . '****' . substr($phone, -4);
    }
}
