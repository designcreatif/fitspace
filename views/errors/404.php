<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | FitSpace</title>
    <?php require ROOT_PATH . '/views/partials/theme-head.php'; ?>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
<header class="bg-background border-b-2 border-surface-variant fixed top-0 w-full z-50 flex justify-between items-center px-margin-mobile h-16">
    <a href="<?= APP_URL ?>/" class="font-headline-lg-mobile italic font-black text-primary tracking-tighter uppercase">FITSPACE</a>
    <a href="<?= APP_URL ?>/login" class="material-symbols-outlined text-primary">account_circle</a>
</header>
<main class="flex-grow flex items-center justify-center pt-24 pb-12 px-margin-mobile">
    <div class="max-w-container-max mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
            <div class="lg:col-span-7 space-y-8">
                <span class="inline-block px-4 py-1 bg-primary text-on-primary font-label-md rounded-full uppercase tracking-widest">Erreur 404</span>
                <h1 class="font-headline-xl text-headline-xl">Page introuvable</h1>
                <p class="font-body-lg text-secondary max-w-xl">La page que vous recherchez n'existe pas ou a été déplacée.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?= APP_URL ?>/" class="bg-primary-container text-on-primary px-8 py-4 font-label-md uppercase tracking-wider flex items-center justify-center gap-2 hover:opacity-90 active:scale-95">
                        <span class="material-symbols-outlined">home</span> Retour à l'accueil
                    </a>
                    <a href="<?= APP_URL ?>/offres" class="border-2 border-on-background px-8 py-4 font-label-md uppercase tracking-wider flex items-center justify-center gap-2 hover:bg-surface-container active:scale-95">
                        Nos offres
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5">
                <div class="bg-surface-container-low p-8 border border-surface-variant">
                    <span class="material-symbols-outlined text-primary text-6xl">fitness_center</span>
                    <p class="font-headline-md mt-4">Même nos haltères n'ont pas trouvé cette URL.</p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
