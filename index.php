<?php

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/theme.php';

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'gc_maxlifetime' => SESSION_LIFETIME,
]);

spl_autoload_register(function (string $class): void {
    $paths = [
        ROOT_PATH . '/core/',
        ROOT_PATH . '/controllers/',
        ROOT_PATH . '/models/',
        ROOT_PATH . '/middleware/',
    ];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once ROOT_PATH . '/helpers/functions.php';

set_exception_handler(function (Throwable $e): void {
    error_log($e->getMessage() . "\n" . $e->getTraceAsString());
    http_response_code(500);
    $errorMessage = ini_get('display_errors') ? $e->getMessage() : '';
    if (!defined('THEME_HERO_IMG')) {
        require_once ROOT_PATH . '/config/theme.php';
    }
    require ROOT_PATH . '/views/errors/500.php';
    exit;
});

$router = new Router();

$router->get('/', 'HomeController', 'index');
$router->get('/offres', 'ArticleController', 'index');
$router->get('/offres/{id}', 'ArticleController', 'show');

$router->get('/register', 'AuthController', 'registerForm', ['GuestMiddleware']);
$router->post('/register', 'AuthController', 'register', ['GuestMiddleware']);
$router->get('/login', 'AuthController', 'loginForm', ['GuestMiddleware']);
$router->post('/login', 'AuthController', 'login', ['GuestMiddleware']);
$router->get('/logout', 'AuthController', 'logout', ['AuthMiddleware']);
$router->get('/forgot-password', 'AuthController', 'forgotForm', ['GuestMiddleware']);
$router->post('/forgot-password', 'AuthController', 'forgot', ['GuestMiddleware']);
$router->get('/reset-password', 'AuthController', 'resetForm', ['GuestMiddleware']);
$router->post('/reset-password', 'AuthController', 'reset', ['GuestMiddleware']);

$router->get('/dashboard', 'UserController', 'dashboard', ['AuthMiddleware']);
$router->get('/profile', 'UserController', 'profile', ['AuthMiddleware']);
$router->post('/profile', 'UserController', 'updateProfile', ['AuthMiddleware']);
$router->post('/reservation/create', 'ReservationController', 'create', ['AuthMiddleware']);
$router->post('/reservation/cancel', 'ReservationController', 'cancel', ['AuthMiddleware']);
$router->get('/admin', 'AdminController', 'dashboard', ['AdminMiddleware']);
$router->get('/admin/users', 'AdminUserController', 'index', ['AdminMiddleware']);
$router->get('/admin/users/create', 'AdminUserController', 'create', ['AdminMiddleware']);
$router->post('/admin/users/create', 'AdminUserController', 'store', ['AdminMiddleware']);
$router->get('/admin/users/{id}', 'AdminUserController', 'show', ['AdminMiddleware']);
$router->get('/admin/users/{id}/edit', 'AdminUserController', 'edit', ['AdminMiddleware']);
$router->post('/admin/users/{id}/edit', 'AdminUserController', 'update', ['AdminMiddleware']);
$router->post('/admin/users/{id}/delete', 'AdminUserController', 'delete', ['AdminMiddleware']);

$router->get('/admin/articles', 'AdminArticleController', 'index', ['AdminMiddleware']);
$router->get('/admin/articles/create', 'AdminArticleController', 'create', ['AdminMiddleware']);
$router->post('/admin/articles/create', 'AdminArticleController', 'store', ['AdminMiddleware']);
$router->get('/admin/articles/{id}/edit', 'AdminArticleController', 'edit', ['AdminMiddleware']);
$router->get(
    '/admin/reservations',
    'AdminReservationController',
    'index',
    ['AdminMiddleware']
);
$router->post('/admin/articles/{id}/edit', 'AdminArticleController', 'update', ['AdminMiddleware']);
$router->post('/admin/articles/{id}/delete', 'AdminArticleController', 'delete', ['AdminMiddleware']);

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$router->dispatch($uri, $method);

