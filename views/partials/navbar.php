<header class="fixed top-0 w-full z-50 bg-background border-b-2 border-surface-variant h-16 flex justify-between items-center px-margin-mobile md:px-margin-desktop">
    <div class="flex items-center gap-4">
        <details class="md:hidden relative">
            <summary class="material-symbols-outlined text-primary cursor-pointer list-none">menu</summary>
            <nav class="absolute top-12 left-0 bg-surface-container-lowest border border-surface-variant shadow-lg py-2 min-w-[200px] z-50">
                <a class="block px-4 py-2 font-label-md hover:bg-surface-container-low" href="<?= APP_URL ?>/">Accueil</a>
                <a class="block px-4 py-2 font-label-md hover:bg-surface-container-low" href="<?= APP_URL ?>/offres">Offres</a>
                <?php if (Auth::check() && !Auth::isAdmin()): ?>
                <a class="block px-4 py-2 font-label-md hover:bg-surface-container-low" href="<?= APP_URL ?>/dashboard">Mon espace</a>
                <a class="block px-4 py-2 font-label-md hover:bg-surface-container-low" href="<?= APP_URL ?>/profile">Profil</a>
                <?php endif; ?>
            </nav>
        </details>
        <a href="<?= APP_URL ?>/" class="font-headline-lg-mobile md:text-headline-lg italic font-black text-primary tracking-tighter uppercase">FITSPACE</a>
    </div>

    <nav class="hidden md:flex gap-8 items-center h-full">
        <a class="<?= navLinkClass('/') ?>" href="<?= APP_URL ?>/">Accueil</a>
        <a class="<?= navLinkClass('/offres') ?>" href="<?= APP_URL ?>/offres">Offres</a>
        <?php if (Auth::check() && !Auth::isAdmin()): ?>
        <a class="<?= navLinkClass('/dashboard') ?>" href="<?= APP_URL ?>/dashboard">Mon espace</a>
        <?php endif; ?>
    </nav>

    <div class="flex items-center gap-3 md:gap-4">
        <?php if (Auth::check()): ?>
            <?php if (Auth::isAdmin()): ?>
            <a href="<?= APP_URL ?>/admin" class="hidden sm:inline font-label-md text-label-md text-on-surface hover:text-primary">Admin</a>
            <?php else: ?>
            <a href="<?= APP_URL ?>/profile" class="material-symbols-outlined text-primary hover:opacity-80" title="Profil">account_circle</a>
            <?php endif; ?>
            <a href="<?= APP_URL ?>/logout" class="font-label-sm text-label-sm text-secondary hover:text-primary uppercase">Déconnexion</a>
        <?php else: ?>
            <a href="<?= APP_URL ?>/login" class="hidden sm:inline font-label-md text-label-md text-on-surface hover:text-primary">Connexion</a>
            <a href="<?= APP_URL ?>/register" class="bg-primary-container text-on-primary px-4 py-2 font-label-md text-label-md uppercase tracking-wider hover:opacity-90 active:scale-95 transition-all text-sm">S'inscrire</a>
        <?php endif; ?>
    </div>
</header>
