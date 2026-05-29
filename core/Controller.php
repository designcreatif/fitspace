<?php

class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        $data['flash'] = $this->getFlash();
        $data['csrf_token'] = $this->csrfToken();
        extract($data);
        $viewFile = ROOT_PATH . '/views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new RuntimeException("Vue introuvable : {$view}");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require ROOT_PATH . '/views/layouts/' . $layout . '.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function verifyCsrf(): bool
    {
        $token = $this->input('csrf_token', '');
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function getFlash(): ?array
    {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $flash;
    }

    protected function error403(): void
    {
        http_response_code(403);
        require ROOT_PATH . '/views/errors/403.php';
        exit;
    }

    protected function error500(string $message = ''): void
    {
        http_response_code(500);
        $errorMessage = $message;
        require ROOT_PATH . '/views/errors/500.php';
        exit;
    }
}

