<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-margin-mobile md:px-margin-desktop py-12">
    <div class="w-full max-w-md bg-surface-container-lowest p-8 md:p-12 border border-surface-variant">
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-6 text-center">Nouveau mot de passe</h1>

        <?php if (!empty($error)): ?>
        <div class="bg-error-container border-l-4 border-error p-4 font-body-md text-on-error-container mb-6"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/reset-password" class="space-y-5">
            <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
            <input type="hidden" name="token" value="<?= e($token) ?>">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="password">Nouveau mot de passe</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="password" name="password" type="password" required minlength="8"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="password_confirm">Confirmer</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="password_confirm" name="password_confirm" type="password" required minlength="8"/>
            </div>
            <button type="submit" class="w-full bg-primary-container text-on-primary py-4 font-label-md uppercase tracking-widest hover:opacity-90">Réinitialiser</button>
        </form>
    </div>
</div>
