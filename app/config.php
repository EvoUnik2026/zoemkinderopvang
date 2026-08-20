<?php
/**
 * Central config - ZOEM Kinderopvang
 * Reads .env and exposes app & database settings.
 */
declare(strict_types=1);

$env = [];
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $env = parse_ini_file($envFile, false, INI_SCANNER_RAW) ?: [];
}

return [
    'db' => [
        'host'    => $env['DB_HOST'] ?? '127.0.0.1',
        'name'    => $env['DB_NAME'] ?? 'zoemkinderopvang',
        'user'    => $env['DB_USER'] ?? 'root',
        'pass'    => $env['DB_PASSWORD'] ?? '',
        'charset' => 'utf8mb4',
    ],
    'app' => [
        'name' => 'ZOEM Kinderopvang',
        'url'  => rtrim($env['APP_URL'] ?? 'http://localhost:8080', '/'),
        'env'  => $env['APP_ENV'] ?? 'development',
    ],
    'log' => [
        'level' => strtolower($env['LOG_LEVEL'] ?? 'info'),
        'dir'   => __DIR__ . '/../logs',
    ],
];