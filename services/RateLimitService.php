<?php
/**
 * IP-based Rate Limiter Service
 * Replicates `checkRateLimit('checkout:{ip}', 10, 60)` from user reference code.
 * Allows max 10 checkout creations per 60 seconds per IP.
 */

class RateLimitService {
    private string $storageDir;

    public function __construct() {
        $this->storageDir = dirname(__DIR__) . '/storage/ratelimit';
        if (!is_dir($this->storageDir)) {
            @mkdir($this->storageDir, 0755, true);
        }
    }

    /**
     * Check if client IP is within rate limits
     *
     * @param string $ip Client IP address
     * @param int $maxRequests Max requests allowed (default 10)
     * @param int $windowSeconds Window in seconds (default 60)
     * @return array ['success' => bool, 'remaining' => int, 'retry_after' => int]
     */
    public function check(string $ip, int $maxRequests = 10, int $windowSeconds = 60): array {
        $key = md5('checkout:' . $ip);
        $file = $this->storageDir . '/' . $key . '.json';
        $now = time();

        $timestamps = [];
        if (file_exists($file)) {
            $data = json_decode((string)@file_get_contents($file), true);
            if (is_array($data)) {
                // Filter out timestamps older than the window
                $timestamps = array_filter($data, fn($t) => ($now - $t) < $windowSeconds);
            }
        }

        if (count($timestamps) >= $maxRequests) {
            $oldestInWindow = min($timestamps);
            $retryAfter = max(1, $windowSeconds - ($now - $oldestInWindow));
            return [
                'success'     => false,
                'remaining'   => 0,
                'retry_after' => $retryAfter,
                'error'       => "Too many checkout requests. Please try again in {$retryAfter} seconds."
            ];
        }

        // Add current timestamp and save
        $timestamps[] = $now;
        @file_put_contents($file, json_encode(array_values($timestamps)));

        return [
            'success'   => true,
            'remaining' => $maxRequests - count($timestamps),
            'retry_after' => 0
        ];
    }

    /**
     * Helper to retrieve client IP safely
     */
    public static function getClientIp(): string {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ips = explode(',', $_SERVER[$header]);
                $ip = trim($ips[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}

