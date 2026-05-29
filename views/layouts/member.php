<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'FitSpace') ?> | FitSpace</title>
    <?php require ROOT_PATH . '/views/partials/theme-head.php'; ?>
</head>
<body class="bg-background text-on-background font-body-md">
    <?php require ROOT_PATH . '/views/partials/navbar.php'; ?>

    <div class="flex min-h-screen pt-16">
        <?php require ROOT_PATH . '/views/partials/member-sidebar.php'; ?>
        <main class="flex-1 px-margin-mobile md:px-margin-desktop py-8 max-w-container-max mx-auto w-full pb-24 md:pb-8">
            <?php if (!empty($flash)): ?>
            <div class="mb-6">
                <?php require ROOT_PATH . '/views/partials/flash.php'; ?>
            </div>
            <?php endif; ?>
            <?= $content ?>
        </main>
    </div>

    <?php require ROOT_PATH . '/views/partials/footer.php'; ?>
    <?php require ROOT_PATH . '/views/partials/member-mobile-nav.php'; ?>
</body>
</html>
