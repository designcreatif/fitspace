<?php

class ArticleController extends Controller
{
    public function index(): void
    {
        $articleModel = new Article();
        $articles = $articleModel->published();

        $this->view('articles/index', [
            'title' => 'Nos offres',
            'articles' => $articles,
        ]);
    }

    public function show(string $id): void
    {
        $articleModel = new Article();
        $article = $articleModel->findPublished((int) $id);

        if (!$article) {
            http_response_code(404);
            require ROOT_PATH . '/views/errors/404.php';
            return;
        }

        $this->view('articles/show', [
            'title' => $article['title'],
            'article' => $article,
        ]);
    }
}

