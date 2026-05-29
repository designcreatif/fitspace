<nav class="md:hidden fixed bottom-0 left-0 w-full bg-surface-container-lowest border-t-2 border-surface-variant flex justify-around items-center h-16 z-50">
    <a class="flex flex-col items-center gap-1 <?= isActivePath('/dashboard') ? 'text-primary' : 'text-on-surface-variant' ?>" href="<?= APP_URL ?>/dashboard">
        <span class="material-symbols-outlined" style="<?= isActivePath('/dashboard') ? "font-variation-settings: 'FILL' 1" : '' ?>">dashboard</span>
        <span class="font-label-sm">Bord</span>
    </a>
    <a class="flex flex-col items-center gap-1 <?= isActivePath('/offres') ? 'text-primary' : 'text-on-surface-variant' ?>" href="<?= APP_URL ?>/offres">
        <span class="material-symbols-outlined" style="<?= isActivePath('/offres') ? "font-variation-settings: 'FILL' 1" : '' ?>">fitness_center</span>
        <span class="font-label-sm">Offres</span>
    </a>
    <a class="flex flex-col items-center gap-1 <?= isActivePath('/profile') ? 'text-primary' : 'text-on-surface-variant' ?>" href="<?= APP_URL ?>/profile">
        <span class="material-symbols-outlined" style="<?= isActivePath('/profile') ? "font-variation-settings: 'FILL' 1" : '' ?>">person</span>
        <span class="font-label-sm">Profil</span>
    </a>
</nav>
