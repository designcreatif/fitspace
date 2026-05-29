<?php

class AdminMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            header('Location: ' . APP_URL . '/login');
            exit;
        }

        if (!Auth::isAdmin()) {
            http_response_code(403);
            require ROOT_PATH . '/views/errors/403.php';
            exit;
        }
    }
}

