<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'FitSpace') ?> | FitSpace</title>
    <?php require ROOT_PATH . '/views/partials/theme-head.php'; ?>
</head>
<body class="bg-background text-on-surface font-body-md overflow-x-hidden">
    <?php require ROOT_PATH . '/views/partials/navbar.php'; ?>

    <main class="mt-16">
        <?php if (!empty($flash)): ?>
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-4">
            <?php require ROOT_PATH . '/views/partials/flash.php'; ?>
        </div>
        <?php endif; ?>
        <?= $content ?>
    </main>

    <?php require ROOT_PATH . '/views/partials/footer.php'; ?>
</body>
</html>
