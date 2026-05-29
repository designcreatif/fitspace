<div class="mb-4">
    <a href="<?= APP_URL ?>/admin/articles" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Retour</a>
</div>
<h1 class="h3 mb-4"><?= $article ? 'Modifier' : 'Créer' ?> une offre</h1>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<div class="card p-4">
    <form method="POST" action="<?= $article ? APP_URL . '/admin/articles/' . (int)$article['id'] . '/edit' : APP_URL . '/admin/articles/create' ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= e($csrf_token) ?>">
        <div class="mb-3">
            <label class="form-label">Titre *</label>
            <input type="text" name="title" class="form-control" required value="<?= e($article['title'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Slug (auto si vide)</label>
            <input type="text" name="slug" class="form-control" value="<?= e($article['slug'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description courte *</label>
            <textarea name="short_description" class="form-control" rows="2" required><?= e($article['short_description'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Description complète *</label>
            <textarea name="full_description" class="form-control" rows="6" required><?= e($article['full_description'] ?? '') ?></textarea>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <?php if (!empty($article['image'])): ?>
                <img src="<?= articleImageUrl($article['image']) ?>" class="mt-2 rounded" width="120" alt="">
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="published" <?= ($article['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Publié</option>
                    <option value="draft" <?= ($article['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Date de publication</label>
                <input type="datetime-local" name="published_at" class="form-control"
                    value="<?= isset($article['published_at']) ? date('Y-m-d\TH:i', strtotime($article['published_at'])) : date('Y-m-d\TH:i') ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Enregistrer</button>
    </form>
</div>
