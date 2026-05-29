<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h1 class="h3 mb-0">Offres & services</h1>
    <a href="<?= APP_URL ?>/admin/articles/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Créer</a>
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
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Publié le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><img src="<?= articleImageUrl($article['image']) ?>" alt="" width="60" height="40" style="object-fit:cover;border-radius:4px"></td>
                    <td><?= e($article['title']) ?></td>
                    <td><span class="badge bg-<?= $article['status'] === 'published' ? 'success' : 'warning' ?>"><?= e($article['status']) ?></span></td>
                    <td><?= formatDate($article['published_at']) ?></td>
                    <td class="table-actions">
                        <a href="<?= APP_URL ?>/offres/<?= (int) $article['id'] ?>" class="btn btn-sm btn-outline-info" target="_blank"><i class="bi bi-eye"></i></a>
                        <a href="<?= APP_URL ?>/admin/articles/<?= (int) $article['id'] ?>/edit" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="<?= APP_URL ?>/admin/articles/<?= (int) $article['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Supprimer cette offre ?')">
                            <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
