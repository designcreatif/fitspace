<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Admin') ?> | FitSpace Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= APP_URL ?>/public/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= APP_URL ?>/admin">Fit<span style="color:#e63946">Space</span> Admin</a>
            <div class="d-flex gap-2">
                <a href="<?= APP_URL ?>/" class="btn btn-outline-light btn-sm">Voir le site</a>
                <a href="<?= APP_URL ?>/logout" class="btn btn-danger btn-sm">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 admin-sidebar py-4">
                <ul class="nav flex-column px-3">
                    <li class="nav-item">
                        <a class="nav-link <?= !str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/users') && !str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/articles') ? 'active' : '' ?>" href="<?= APP_URL ?>/admin">
                            <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/users') ? 'active' : '' ?>" href="<?= APP_URL ?>/admin/users">
                            <i class="bi bi-people me-2"></i> Utilisateurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'] ?? '', '/admin/articles') ? 'active' : '' ?>" href="<?= APP_URL ?>/admin/articles">
                            <i class="bi bi-box-seam me-2"></i> Offres
                        </a>
                    </li>
                </ul>
            </nav>
            <main class="col-md-9 col-lg-10 py-4 px-4">
                <?php if (!empty($flash)): ?>
                <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show">
                    <?= e($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



