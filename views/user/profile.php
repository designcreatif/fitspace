<section class="mb-8">
    <div class="flex items-center gap-6 mb-8">

    <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-primary">

        <?php if (!empty($user['avatar'])): ?>
            <img
src="/fitspace/public/uploads/avatars/<?= e($user['avatar']) ?>"
alt="Avatar"
class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-surface-container flex items-center justify-center">
                <span class="material-symbols-outlined text-5xl text-primary">
                    person
                </span>
            </div>
        <?php endif; ?>

    </div>

    <div>
        <h2 class="font-headline-lg text-headline-lg">
            <?= e($user['first_name'] . ' ' . $user['last_name']) ?>
        </h2>

        <p class="text-secondary">
            <?= e($user['email']) ?>
        </p>
    </div>

</div>
   <section class="grid md:grid-cols-3 gap-gutter mb-10">

    <div class="border border-surface-variant p-6">
        <p class="font-label-md text-secondary uppercase">
            Abonnement
        </p>

        <h3 class="font-headline-md mt-2 text-primary">
            <?= strtoupper($user['membership'] ?? 'BASIC') ?>
        </h3>
    </div>

    <div class="border border-surface-variant p-6">
        <p class="font-label-md text-secondary uppercase">
            Membre depuis
        </p>

        <h3 class="font-headline-md mt-2">
            <?= date('d/m/Y', strtotime($user['created_at'])) ?>
        </h3>
    </div>

    <div class="border border-surface-variant p-6">
        <p class="font-label-md text-secondary uppercase">
            Statut
        </p>

        <h3 class="font-headline-md mt-2 text-primary">
            ACTIF
        </h3>
    </div>

</section>

    <h1 class="font-headline-xl text-headline-xl text-on-background uppercase">Mon profil</h1>
    <p class="font-body-md text-secondary mt-2">Modifiez vos informations personnelles et votre mot de passe.</p>
</section>

<?php if (!empty($errors)): ?>
<div class="bg-error-container border-l-4 border-error p-4 mb-6">
    <ul class="font-body-md text-on-error-container space-y-1">
        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="max-w-2xl bg-surface-container-lowest border border-surface-variant p-8 md:p-10">
    <form method="POST"
      action="<?= APP_URL ?>/profile"
      enctype="multipart/form-data"
      class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="first_name">Prénom</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="first_name" name="first_name" required value="<?= e($user['first_name']) ?>"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="last_name">Nom</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="last_name" name="last_name" required value="<?= e($user['last_name']) ?>"/>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-secondary">Email (non modifiable)</label>
            <input class="w-full p-3 bg-surface-container-low border border-surface-variant font-body-md text-secondary" value="<?= e($user['email']) ?>" disabled/>
        </div>

        <hr class="border-surface-variant">
        <h2 class="font-headline-md text-headline-md uppercase">Mot de passe</h2>
        <p class="font-label-sm text-secondary">Laissez vide pour conserver le mot de passe actuel.</p>

        <div class="flex flex-col gap-1.5">
            <label class="font-label-md text-on-surface" for="current_password">Mot de passe actuel</label>
            <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="current_password" name="current_password" type="password"/>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="new_password">Nouveau mot de passe</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="new_password" name="new_password" type="password" minlength="8"/>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-on-surface" for="confirm_password">Confirmer</label>
                <input class="w-full p-3 bg-white border border-surface-variant font-body-md input-focus-effect" id="confirm_password" name="confirm_password" type="password" minlength="8"/>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
    <label class="font-label-md text-on-surface" for="avatar">
        Avatar
    </label>

    <input
        type="file"
        name="avatar"
        id="avatar"
        accept="image/*"
        class="w-full p-3 bg-white border border-surface-variant">
</div>
        <button type="submit" class="w-full md:w-auto bg-primary-container text-on-primary px-10 py-4 font-label-md uppercase tracking-widest hover:opacity-90 active:scale-95">Enregistrer</button>
    </form>
</div>
