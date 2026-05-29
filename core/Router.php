<?php

class Router
{
    private array $routes = [];

    public function get(string $path, string $controller, string $method, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $controller, $method, $middleware);
    }

    public function post(string $path, string $controller, string $method, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $controller, $method, $middleware);
    }

    private function addRoute(string $httpMethod, string $path, string $controller, string $method, array $middleware): void
    {
        $this->routes[] = [
            'method' => $httpMethod,
            'path' => $path,
            'controller' => $controller,
            'action' => $method,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(string $uri, string $httpMethod): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $basePath = parse_url(APP_URL, PHP_URL_PATH) ?: '';
        if ($basePath && str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath)) ?: '/';
        }
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '([^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === $httpMethod && preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                foreach ($route['middleware'] as $mw) {
                    $middleware = new $mw();
                    $middleware->handle();
                }

                $controllerName = $route['controller'];
                $action = $route['action'];

                if (!class_exists($controllerName)) {
                    $this->error404();
                    return;
                }

                $controller = new $controllerName();
                if (!method_exists($controller, $action)) {
                    $this->error404();
                    return;
                }

                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        $this->error404();
    }

    private function error404(): void
    {
        http_response_code(404);
        require ROOT_PATH . '/views/errors/404.php';
        exit;
    }
}

