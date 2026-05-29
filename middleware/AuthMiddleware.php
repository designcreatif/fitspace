<?php

class AuthMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: ' . APP_URL . '/login');
            exit;
        }
    }
}

