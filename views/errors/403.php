<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | FitSpace</title>
    <?php require ROOT_PATH . '/views/partials/theme-head.php'; ?>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
<header class="bg-background border-b-2 border-surface-variant fixed top-0 w-full z-50 flex justify-between items-center px-margin-mobile h-16">
    <a href="<?= APP_URL ?>/" class="font-headline-lg-mobile italic font-black text-primary tracking-tighter uppercase">FITSPACE</a>
</header>
<main class="flex-grow flex items-center justify-center pt-24 pb-12 px-margin-mobile text-center">
    <div class="max-w-lg space-y-6">
        <span class="inline-block px-4 py-1 bg-primary text-on-primary font-label-md rounded-full uppercase tracking-widest">Erreur 403</span>
        <h1 class="font-headline-xl text-headline-xl">Accès refusé</h1>
        <p class="font-body-lg text-secondary">Vous n'avez pas les permissions nécessaires pour accéder à cette page.</p>
        <a href="<?= APP_URL ?>/" class="inline-flex bg-primary-container text-on-primary px-8 py-4 font-label-md uppercase tracking-wider hover:opacity-90">Retour à l'accueil</a>
    </div>
</main>
</body>
</html>
