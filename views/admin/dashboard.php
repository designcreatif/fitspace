<h1 class="h3 mb-4">Tableau de bord</h1>
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card users">
            <h3 class="display-6 fw-bold"><?= (int) $stats['users'] ?></h3>
            <p class="mb-0">Utilisateurs inscrits</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card articles">
            <h3 class="display-6 fw-bold"><?= (int) $stats['articles'] ?></h3>
            <p class="mb-0">Offres totales</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card published">
            <h3 class="display-6 fw-bold"><?= (int) $stats['published'] ?></h3>
            <p class="mb-0">Offres publiées</p>
        </div>
    </div>
</div>
<div class="card p-4">
    <h5>Actions rapides</h5>
    <div class="d-flex flex-wrap gap-2 mt-3">
        <a href="<?= APP_URL ?>/admin/users/create" class="btn btn-primary"><i class="bi bi-person-plus"></i> Nouvel utilisateur</a>
        <a href="<?= APP_URL ?>/admin/articles/create" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i> Nouvelle offre</a>
        <a href="<?= APP_URL ?>/admin/users" class="btn btn-outline-secondary">Gérer les utilisateurs</a>
        <a href="<?= APP_URL ?>/admin/articles" class="btn btn-outline-secondary">Gérer les offres</a>
    </div>
</div>
