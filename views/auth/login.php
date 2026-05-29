<div class="min-h-[calc(100vh-4rem)] flex flex-col items-center justify-center px-margin-mobile md:px-margin-desktop py-12">
    <div class="w-full max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
        <div class="hidden lg:block lg:col-span-7 h-[600px] relative overflow-hidden bg-surface-container-low rounded-xl">
            <img alt="FitSpace" class="absolute inset-0 w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="<?= THEME_AUTH_IMG ?>"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-12 text-white">
                <h2 class="font-headline-xl text-headline-xl mb-4">REPOUSSEZ VOS LIMITES.</h2>
                <p class="font-body-lg opacity-90 max-w-md">L'excellence n'est pas un acte, mais une habitude. Bienvenue dans l'espace où la précision rencontre la puissance.</p>
            </div>
        </div>
        <div class="lg:col-span-5 flex flex-col gap-8 bg-surface-container-lowest p-8 md:p-12 border border-surface-variant rounded-xl">
            <div class="space-y-2">
                <h1 class="font-headline-lg text-headline-lg text-on-surface">Connexion</h1>
                <p class="font-body-md text-secondary">Entrez vos identifiants pour accéder à votre espace membre.</p>
            </div>

            <?php if (!empty($error)): ?>
            <div class="bg-error-container border-l-4 border-error p-4 font-body-md text-on-error-container"><?= e($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= APP_URL ?>/login" class="flex flex-col gap-6">
                <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-on-surface uppercase tracking-wider" for="login">E-mail ou nom d'utilisateur</label>
                    <input class="w-full h-14 px-4 bg-white border border-surface-variant font-body-md input-focus-effect" id="login" name="login" type="text" required value="<?= e($old_login ?? '') ?>"/>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <label class="font-label-md text-on-surface uppercase tracking-wider" for="password">Mot de passe</label>
                        <a class="font-label-sm text-secondary hover:text-primary" href="<?= APP_URL ?>/forgot-password">Mot de passe oublié ?</a>
                    </div>
                    <input class="w-full h-14 px-4 bg-white border border-surface-variant font-body-md input-focus-effect" id="password" name="password" type="password" required/>
                </div>
                <button type="submit" class="w-full h-14 bg-primary-container text-on-primary font-label-md uppercase tracking-widest hover:bg-primary transition-colors active:scale-95">Se connecter</button>
            </form>
            <div class="flex flex-col gap-4 items-center">
                <div class="w-full h-px bg-surface-variant"></div>
                <p class="font-body-md text-secondary">Pas encore de compte ?</p>
                <a href="<?= APP_URL ?>/register" class="w-full h-14 border-2 border-on-surface font-label-md uppercase tracking-widest flex items-center justify-center hover:bg-on-surface hover:text-white transition-all active:scale-95">Devenir membre</a>
            </div>
        </div>
    </div>
</div>
