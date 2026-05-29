<?php

class AdminArticleController extends Controller
{
    private Article $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    public function index(): void
    {
        $search = trim($this->input('q', ''));
        $articles = $this->articleModel->all($search);

        $this->view('admin/articles/index', [
            'title' => 'Gestion des offres',
            'articles' => $articles,
            'search' => $search,
        ], 'admin');
    }

    public function create(): void
    {
        $this->view('admin/articles/form', [
            'title' => 'Créer une offre',
            'article' => null,
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token invalide.');
            $this->redirect(APP_URL . '/admin/articles/create');
        }

        $data = $this->validateArticleForm();
        if (isset($data['errors'])) {
            $this->view('admin/articles/form', [
                'title' => 'Créer une offre',
                'article' => $data['old'],
                'errors' => $data['errors'],
            ], 'admin');
            return;
        }

        $image = uploadImage($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
        $data['image'] = $image;
        $data['author_id'] = Auth::id();

        $this->articleModel->create($data);
        $this->flash('success', 'Offre créée.');
        $this->redirect(APP_URL . '/admin/articles');
    }

    public function edit(string $id): void
    {
        $article = $this->articleModel->findById((int) $id);
        if (!$article) {
            $this->flash('danger', 'Offre introuvable.');
            $this->redirect(APP_URL . '/admin/articles');
        }

        $this->view('admin/articles/form', [
            'title' => 'Modifier une offre',
            'article' => $article,
        ], 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token invalide.');
            $this->redirect(APP_URL . '/admin/articles/' . $id . '/edit');
        }

        $articleId = (int) $id;
        $existing = $this->articleModel->findById($articleId);
        if (!$existing) {
            $this->flash('danger', 'Offre introuvable.');
            $this->redirect(APP_URL . '/admin/articles');
        }

        $data = $this->validateArticleForm($articleId);
        if (isset($data['errors'])) {
            $this->view('admin/articles/form', [
                'title' => 'Modifier une offre',
                'article' => array_merge($existing, $data['old']),
                'errors' => $data['errors'],
            ], 'admin');
            return;
        }

        $image = uploadImage($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE], $existing['image']);
        if ($image !== null) {
            $data['image'] = $image;
        }

        $this->articleModel->update($articleId, $data);
        $this->flash('success', 'Offre mise à jour.');
        $this->redirect(APP_URL . '/admin/articles');
    }

    public function delete(string $id): void
    {
        if (!$this->verifyCsrf()) {
            $this->error403();
        }

        $this->articleModel->delete((int) $id);
        $this->flash('success', 'Offre supprimée.');
        $this->redirect(APP_URL . '/admin/articles');
    }

    private function validateArticleForm(?int $excludeId = null): array
    {
        $title = trim($this->input('title', ''));
        $slug = trim($this->input('slug', '')) ?: slugify($title);
        $shortDescription = trim($this->input('short_description', ''));
        $fullDescription = trim($this->input('full_description', ''));
        $status = $this->input('status', 'published');
        $publishedAt = $this->input('published_at', date('Y-m-d H:i:s'));

        $errors = [];
        $old = [
            'title' => $title,
            'slug' => $slug,
            'short_description' => $shortDescription,
            'full_description' => $fullDescription,
            'status' => in_array($status, ['draft', 'published']) ? $status : 'published',
            'published_at' => $publishedAt,
        ];

        if (!$title || !$shortDescription || !$fullDescription) {
            $errors[] = 'Titre et descriptions obligatoires.';
        }

        if ($this->articleModel->slugExists($slug, $excludeId)) {
            $errors[] = 'Ce slug est déjà utilisé.';
        }

        if ($errors) {
            return ['errors' => $errors, 'old' => $old];
        }

        return array_merge($old, ['slug' => $slug]);
    }
}

