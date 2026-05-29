<?php

class GuestMiddleware
{
    public function handle(): void
    {
        if (Auth::check()) {
            $redirect = Auth::isAdmin() ? APP_URL . '/admin' : APP_URL . '/dashboard';
            header('Location: ' . $redirect);
            exit;
        }
    }
}

