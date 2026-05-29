<?php

define('APP_NAME', 'FitSpace');
define('APP_URL', 'http://localhost/fitspace');
define('ROOT_PATH', dirname(__DIR__));
define('UPLOAD_PATH', ROOT_PATH . '/public/uploads/');
define('UPLOAD_URL', APP_URL . '/public/uploads/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'fitspace');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('SESSION_LIFETIME', 3600);
define('RESET_TOKEN_EXPIRY', 3600);

date_default_timezone_set('Europe/Paris');

error_reporting(E_ALL);
ini_set('display_errors', 1);

