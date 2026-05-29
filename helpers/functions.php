<?php

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify(string $text): string
{
    if (function_exists('transliterator_transliterate')) {
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $text) ?: $text;
    } else {
        $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = $converted ?: $text;
        $text = strtolower($text);
    }
    $text = preg_replace('/[^a-z0-9]+/', '-', strtolower($text));
    return trim($text, '-') ?: 'article';
}

function uploadImage(array $file, ?string $oldImage = null): ?string
{
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return $oldImage;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowed, true)) {
        return null;
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        return null;
    }

    if (!is_dir(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH, 0755, true);
    }

    $ext = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        default => 'jpg',
    };

    $filename = uniqid('img_', true) . '.' . $ext;
    $destination = UPLOAD_PATH . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return null;
    }

    if ($oldImage && file_exists(UPLOAD_PATH . $oldImage)) {
        unlink(UPLOAD_PATH . $oldImage);
    }

    return $filename;
}

function articleImageUrl(?string $image): string
{
    if ($image && file_exists(UPLOAD_PATH . $image)) {
        return UPLOAD_URL . $image;
    }
    return APP_URL . '/public/assets/img/Abonnement Premium.jpg';
}

function formatDate(?string $date): string
{
    if (!$date) {
        return '';
    }
    $dt = new DateTime($date);
    return $dt->format('d/m/Y');
}

function formatDateTime(?string $date): string
{
    if (!$date) {
        return '';
    }
    $dt = new DateTime($date);
    return $dt->format('d/m/Y à H:i');
}

function currentPath(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $basePath = parse_url(APP_URL, PHP_URL_PATH) ?: '';
    if ($basePath && str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath)) ?: '/';
    }
    return rtrim($uri, '/') ?: '/';
}

function isActivePath(string $path): bool
{
    $current = currentPath();
    if ($path === '/') {
        return $current === '/';
    }
    return str_starts_with($current, rtrim($path, '/'));
}

function navLinkClass(string $path): string
{
    $base = 'font-label-md text-label-md h-full flex items-center transition-colors duration-200';
    if (isActivePath($path)) {
        return $base . ' text-primary active-nav-border';
    }
    return $base . ' text-on-surface hover:text-primary';
}

function memberNavClass(string $path): string
{
    $base = 'flex items-center gap-3 px-4 py-3 rounded-lg font-label-md text-label-md transition-all';
    if (isActivePath($path)) {
        return $base . ' bg-primary text-on-primary font-bold';
    }
    return $base . ' text-on-surface-variant hover:bg-surface-variant';
}

