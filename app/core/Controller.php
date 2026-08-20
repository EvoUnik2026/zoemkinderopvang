<?php
/**
 * Core Controller - ZOEM Kinderopvang
 * Base controller with render, redirect and JSON helpers.
 */
declare(strict_types=1);

namespace core;

use core\View;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        (new View())->render($view, $data);
    }

    protected function redirect(string $path, string $message = '', string $type = 'success'): void
    {
        if ($message !== '') {
            flash($type, $message);
        }
        header('Location: ' . $path);
        exit;
    }

    protected function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}