<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $articleModel = new Article();
        $articles = $articleModel->published(3);

        $this->view('home/index', [
            'title' => 'Accueil',
            'articles' => $articles,
        ]);
    }
}

