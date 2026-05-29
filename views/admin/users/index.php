<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0">Utilisateurs</h1>
    <a href="<?= APP_URL ?>/admin/users/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Créer</a>
</div>

<form method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= e($search) ?>">
        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Inscrit le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= (int) $user['id'] ?></td>
                    <td><?= e($user['first_name'] . ' ' . $user['last_name']) ?></td>
                    <td><?= e($user['username']) ?></td>
                    <td><?= e($user['email']) ?></td>
                    <td><span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'secondary' ?>"><?= e($user['role']) ?></span></td>
                    <td><?= formatDate($user['created_at']) ?></td>
                    <td class="table-actions">
                        <a href="<?= APP_URL ?>/admin/users/<?= (int) $user['id'] ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        <a href="<?= APP_URL ?>/admin/users/<?= (int) $user['id'] ?>/edit" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <?php if ((int) $user['id'] !== Auth::id()): ?>
                        <form method="POST" action="<?= APP_URL ?>/admin/users/<?= (int) $user['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
