<?php

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $userModel = new User();
        $articleModel = new Article();

        $this->view('admin/dashboard', [
            'title' => 'Administration',
            'stats' => [
                'users' => $userModel->count(),
                'articles' => $articleModel->count(),
                'published' => $articleModel->countPublished(),
            ],
        ], 'admin');
    }
}

