<?php $memberName = Auth::userName(); ?>
<aside class="hidden md:flex flex-col h-[calc(100vh-64px)] w-72 bg-surface-container-low border-r border-surface-variant p-4 gap-2 sticky top-16">
    <div class="flex flex-col gap-1 mb-6 p-4">
        <span class="font-headline-md text-headline-md font-black text-primary"><?= e($memberName) ?></span>
        <span class="font-label-md text-label-md text-secondary">Membre FitSpace</span>
    </div>
    <nav class="flex flex-col gap-2">
        <a class="<?= memberNavClass('/dashboard') ?>" href="<?= APP_URL ?>/dashboard">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Tableau de bord</span>
        </a>
        <a class="<?= memberNavClass('/offres') ?>" href="<?= APP_URL ?>/offres">
            <span class="material-symbols-outlined">fitness_center</span>
            <span>Offres</span>
        </a>
        <a class="<?= memberNavClass('/profile') ?>" href="<?= APP_URL ?>/profile">
            <span class="material-symbols-outlined">person</span>
            <span>Mon profil</span>
        </a>
    </nav>
    <div class="mt-auto">
        <a class="<?= memberNavClass('/logout') ?> text-on-surface-variant" href="<?= APP_URL ?>/logout">
            <span class="material-symbols-outlined">logout</span>
            <span>Déconnexion</span>
        </a>
    </div>
</aside>
