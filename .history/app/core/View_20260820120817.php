<?php
/**
 * Core View - ZOEM Kinderopvang
 * Lightweight template renderer.
 */
declare(strict_types=1);

namespace core;

class View
{
    private array $data = [];

    public function render(string $view, array $data = []): void
    {
        if (!empty($data)) {
            $this->data = array_merge($this->data, $data);
        }

        $header = __DIR__ . '/../views/layouts/header.php';
        $footer = __DIR__ . '/../views/layouts/footer.php';
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            $this->renderError('View not found: ' . $view);
            return;
        }

        // Global flash messages are made available to every template.
        $this->data['flashes'] = get_flash_messages();
        $this->data['base_url'] = rtrim((require __DIR__ . '/../config.php')['app']['url'], '/');

        if (file_exists($header)) {
            $this->includeFile($header, $this->data);
        }

        $this->includeFile($viewPath, $this->data);

        if (file_exists($footer)) {
            $this->includeFile($footer, $this->data);
        }
    }

    private function includeFile(string $file, array $data): void
    {
        extract($data, EXTR_SKIP);
        include $file;
    }

    private function renderError(string $message): void
    {
        echo '<div class="alert alert-error">' . htmlspecialchars($message) . '</div>';
    }
}