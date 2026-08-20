<?php
/**
 * Helper functions - ZOEM Kinderopvang
 * Common helpers for escaping, formatting, CSRF, flash & settings.
 */
declare(strict_types=1);

use core\Database;
use core\Logger;

function escape(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function e(?string $value): string
{
    return escape($value);
}

function esc_url(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function format_euro(float $amount): string
{
    return '€ ' . number_format($amount, 2, ',', '.');
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function csrf_validate(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
}

function flash(string $type, string $message): void
{
    $_SESSION['flash_data'][$type] = $message;
}

function get_flash_messages(): array
{
    $messages = $_SESSION['flash_data'] ?? [];
    unset($_SESSION['flash_data']);
    return $messages;
}

/**
 * Read a setting from DB with fallback (cached).
 */
function setting(string $key, string $default = ''): string
{
    static $cache = null;

    if ($cache === null) {
        $cache = [];
        try {
            $rows = Database::getInstance()->query('SELECT key_name, `value` FROM settings');
            foreach ($rows as $row) {
                $cache[$row['key_name']] = $row['value'];
            }
        } catch (\Throwable $e) {
            Logger::getInstance()->error('setting() query failed: ' . $e->getMessage());
        }
    }

    return $cache[$key] ?? $default;
}

function s(string $key, string $default = ''): string
{
    return setting($key, $default);
}

function render_stars(int $rating): string
{
    $html = '<div class="stars">';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= $rating
            ? '<span class="star filled">&#9733;</span>'
            : '<span class="star">&#9734;</span>';
    }
    $html .= '</div>';
    return $html;
}

function format_date(string $date): string
{
    return date('d M Y', strtotime($date));
}

function truncate(string $text, int $length = 160, string $suffix = '...'): string
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . $suffix;
}

function is_active(string $path): string
{
    $current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $current = rtrim($current, '/') ?: '/';

    if ($path === '/' || $path === '') {
        return ($current === '/') ? ' class="active"' : '';
    }

    return (str_ends_with($current, '/' . trim($path, '/'))) ? ' class="active"' : '';
}

function tel_link(?string $phone): string
{
    return 'tel:' . preg_replace('/[^0-9+]/', '', $phone ?? '');
}

function mailto_link(?string $email): string
{
    return 'mailto:' . escape($email ?? '');
}

function format_time(string $val): string
{
    return date('H:i', strtotime($val));
}

/** Dutch day name for a day-of-week number (1=Monday .. 7=Sunday). */
function name_of_day(int $day): string
{
    $names = [
        1 => 'Maandag',
        2 => 'Dinsdag',
        3 => 'Woensdag',
        4 => 'Donderdag',
        5 => 'Vrijdag',
        6 => 'Zaterdag',
        7 => 'Zondag',
    ];
    return $names[$day] ?? '';
}