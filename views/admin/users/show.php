<div class="mb-4">
    <a href="<?= APP_URL ?>/admin/users" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Retour</a>
</div>
<h1 class="h3 mb-4">Détail utilisateur #<?= (int) $user['id'] ?></h1>
<div class="card p-4">
    <dl class="row mb-0">
        <dt class="col-sm-3">Nom complet</dt>
        <dd class="col-sm-9"><?= e($user['first_name'] . ' ' . $user['last_name']) ?></dd>
        <dt class="col-sm-3">Username</dt>
        <dd class="col-sm-9"><?= e($user['username']) ?></dd>
        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9"><?= e($user['email']) ?></dd>
        <dt class="col-sm-3">Rôle</dt>
        <dd class="col-sm-9"><?= e($user['role']) ?></dd>
        <dt class="col-sm-3">Inscrit le</dt>
        <dd class="col-sm-9"><?= formatDateTime($user['created_at']) ?></dd>
    </dl>
    <a href="<?= APP_URL ?>/admin/users/<?= (int) $user['id'] ?>/edit" class="btn btn-primary mt-3">Modifier</a>
</div>
