<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-margin-mobile md:px-margin-desktop py-12">
    <div class="w-full max-w-md bg-surface-container-lowest p-8 md:p-12 border border-surface-variant">
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2 text-center">Mot de passe oublié</h1>

        <?php if (!empty($sent)): ?>
        <div class="bg-surface-container-low border-l-4 border-primary p-4 font-body-md text-on-surface mb-6"><?= e($message ?? '') ?></div>
        <?php else: ?>
        <p class="font-body-md text-secondary text-center mb-6">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
        <form method="POST" action="<?= APP_URL ?>/forgot-password" class="space-y-5">
            <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="email">Email</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="email" name="email" type="email" required/>
            </div>
            <button type="submit" class="w-full bg-primary-container text-on-primary py-4 font-label-md uppercase tracking-widest hover:opacity-90">Envoyer le lien</button>
        </form>
        <?php endif; ?>
        <p class="mt-6 text-center font-body-md"><a class="text-primary font-bold hover:underline" href="<?= APP_URL ?>/login">Retour à la connexion</a></p>
    </div>
</div>
