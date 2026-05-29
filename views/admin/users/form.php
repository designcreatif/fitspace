<div class="mb-4">
    <a href="<?= APP_URL ?>/admin/users" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Retour</a>
</div>
<h1 class="h3 mb-4"><?= $user ? 'Modifier' : 'Créer' ?> un utilisateur</h1>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<div class="card p-4">
    <form method="POST" action="<?= $user ? APP_URL . '/admin/users/' . (int)$user['id'] . '/edit' : APP_URL . '/admin/users/create' ?>">
        <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Prénom *</label>
                <input type="text" name="first_name" class="form-control" required value="<?= e($user['first_name'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom *</label>
                <input type="text" name="last_name" class="form-control" required value="<?= e($user['last_name'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Username *</label>
                <input type="text" name="username" class="form-control" required value="<?= e($user['username'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" required value="<?= e($user['email'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Mot de passe <?= $user ? '(laisser vide pour ne pas changer)' : '*' ?></label>
                <input type="password" name="password" class="form-control" <?= $user ? '' : 'required minlength="8"' ?>>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rôle</label>
                <select name="role" class="form-select">
                    <option value="user" <?= ($user['role'] ?? 'user') === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Enregistrer</button>
    </form>
</div>
