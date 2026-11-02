<?php
/**
 * Clean & Secure .env Loader
 * Reads environment variables from the root .env file without external dependencies.
 */

if (!isset($GLOBALS['_APP_ENV'])) {
    $GLOBALS['_APP_ENV'] = [];
}

if (!function_exists('load_clean_env')) {
    function load_clean_env($envPath = null) {
        if ($envPath === null) {
            $envPath = dirname(__DIR__) . '/.env';
        }

        if (!file_exists($envPath)) {
            return;
        }

        $content = @file_get_contents($envPath);
        if ($content === false || $content === '') {
            return;
        }

        $lines = preg_split("/\r\n|\n|\r/", $content);
        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments and empty lines
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            // Split on the first '=' character
            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }

            $key = trim($parts[0]);
            $val = trim($parts[1]);

            // Strip enclosing quotes (double or single)
            if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                $val = substr($val, 1, -1);
            }

            // Clean leading/trailing spaces
            $val = trim($val);

            $GLOBALS['_APP_ENV'][$key] = $val;
            $_ENV[$key] = $val;
            $_SERVER[$key] = $val;
            @putenv("{$key}={$val}");
        }
    }
}

// Auto-load on include
load_clean_env();

if (!function_exists('env')) {
    function env($key, $default = null) {
        if (isset($GLOBALS['_APP_ENV'][$key]) && $GLOBALS['_APP_ENV'][$key] !== '') {
            return $GLOBALS['_APP_ENV'][$key];
        }
        $val = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($val === false || $val === null || $val === '') {
            return $default;
        }
        return $val;
    }
}
