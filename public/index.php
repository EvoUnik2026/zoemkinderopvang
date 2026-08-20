<?php
/**
 * Front Controller - ZOEM Kinderopvang
 * All requests are routed here.
 */
declare(strict_types=1);

// Sessions for CSRF + flash messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoloader
spl_autoload_register(function ($class) {
    $base = __DIR__ . '/../';
    $file = $base . 'app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Helpers
require_once __DIR__ . '/../app/helpers.php';

// Environment variables
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_RAW);
    if (is_array($env)) {
        foreach ($env as $key => $value) {
            putenv("$key=$value");
        }
    }
}

// Routes
require_once __DIR__ . '/../routes.php';

$router = new \core\Router();
$router->dispatch();