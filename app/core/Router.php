<?php
/**
 * Core Router - ZOEM Kinderopvang
 * Parses the request and dispatches to the matching controller.
 */
declare(strict_types=1);

namespace core;

class Router
{
    private array $routes = [];
    private string $requestUri;
    private string $requestMethod;

    public function __construct()
    {
        $this->requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Normalise trailing slash (except root)
        if ($this->requestUri !== '/' && str_ends_with($this->requestUri, '/')) {
            $this->requestUri = rtrim($this->requestUri, '/');
        }
        if ($this->requestUri === '') {
            $this->requestUri = '/';
        }
    }

    public function dispatch(): void
    {
        global $routes;
        $this->routes = $routes ?? [];

        foreach ($this->routes as $route) {
            [$method, $pattern, $controller, $action] = $route;

            if ($this->requestMethod !== $method) {
                continue;
            }

            $params = [];
            if ($this->matchRoute($pattern, $params)) {
                $this->executeController($controller, $action, $params);
                return;
            }
        }

        $this->handleNotFound();
    }

    private function matchRoute(string $pattern, array &$params): bool
    {
        if ($pattern === $this->requestUri) {
            return true;
        }

        $regex = preg_replace('/\{[^}]+\}/', '([^/]+)', $pattern);

        if (preg_match('#^' . $regex . '$#', $this->requestUri, $m)) {
            // Extract named params
            preg_match_all('/\{([^}]+)\}/', $pattern, $names);
            array_shift($m);
            foreach ($names[1] as $i => $name) {
                $params[$name] = $m[$i] ?? '';
            }
            return true;
        }

        return false;
    }

    private function executeController(string $controller, string $action, array $params = []): void
    {
        $class = '\\' . ltrim($controller, '\\');

        if (!class_exists($class)) {
            Logger::getInstance()->error('Controller not found: ' . $class);
            $this->handleNotFound();
            return;
        }

        $instance = new $class();

        if (!method_exists($instance, $action)) {
            Logger::getInstance()->error('Action not found: ' . $action . ' on ' . $class);
            $this->handleNotFound();
            return;
        }

        $instance->$action($params);
    }

    private function handleNotFound(): void
    {
        http_response_code(404);
        $view = new View();
        $view->render('errors/404', [
            'page_title'       => '404 - Pagina niet gevonden',
            'meta_description' => 'De opgevraagde pagina kon niet worden gevonden.',
        ]);
    }
}