<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-margin-mobile md:px-margin-desktop py-12">
    <div class="max-w-[1000px] w-full grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest border border-outline-variant overflow-hidden">
        <div class="relative hidden md:flex flex-col justify-end p-margin-desktop text-white bg-on-background min-h-[500px]">
            <img alt="FitSpace" class="absolute inset-0 w-full h-full object-cover opacity-60" src="<?= THEME_REGISTER_IMG ?>"/>
            <div class="relative z-10">
                <h2 class="font-headline-xl text-headline-xl mb-4 leading-none uppercase">AUCUNE<br/>EXCUSE.</h2>
                <p class="font-body-lg text-surface-variant max-w-sm">Rejoignez l'élite et transformez votre vision en réalité avec FITSPACE.</p>
            </div>
        </div>
        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-8">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Créer un compte</h2>
                <p class="font-body-md text-secondary">Commencez votre voyage vers l'excellence aujourd'hui.</p>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="bg-error-container border-l-4 border-error p-4 mb-6">
                <ul class="font-body-md text-on-error-container space-y-1">
                    <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?= APP_URL ?>/register" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface" for="first_name">Prénom *</label>
                        <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="first_name" name="first_name" required value="<?= e($old['firstName'] ?? $old['first_name'] ?? '') ?>"/>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-on-surface" for="last_name">Nom *</label>
                        <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="last_name" name="last_name" required value="<?= e($old['lastName'] ?? $old['last_name'] ?? '') ?>"/>
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-md text-on-surface" for="username">Nom d'utilisateur *</label>
                    <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="username" name="username" required minlength="3" value="<?= e($old['username'] ?? '') ?>"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-md text-on-surface" for="email">Email *</label>
                    <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="email" name="email" type="email" required value="<?= e($old['email'] ?? '') ?>"/>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-md text-on-surface" for="password">Mot de passe *</label>
                    <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="password" name="password" type="password" required minlength="8"/>
                    <p class="font-label-sm text-secondary">Minimum 8 caractères.</p>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="font-label-md text-on-surface" for="password_confirm">Confirmer *</label>
                    <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="password_confirm" name="password_confirm" type="password" required minlength="8"/>
                </div>
                <button type="submit" class="w-full bg-primary-container text-on-primary py-4 font-label-md uppercase tracking-widest hover:opacity-90 active:scale-[0.98] transition-all">Créer un compte</button>
            </form>
            <p class="mt-8 text-center font-body-md text-on-surface-variant">
                Déjà inscrit ? <a class="text-primary font-bold hover:underline" href="<?= APP_URL ?>/login">Se connecter</a>
            </p>
        </div>
    </div>
</div>
