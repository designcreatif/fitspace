<?php

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function dashboard(): void
    {
        $user = $this->userModel->findById(Auth::id());

        $stats = $this->userModel->getStats(Auth::id());

        $reservations = $this->userModel->getReservations(Auth::id());

        $articleModel = new Article();
        $articles = $articleModel->published(4);

        $this->view('user/dashboard', [
            'title' => 'Mon espace',
            'user' => $user,
            'stats' => $stats,
            'reservations' => $reservations,
            'articles' => $articles,
        ], 'member');
    }

    public function profile(): void
    {
        $user = $this->userModel->findById(Auth::id());

        $this->view('user/profile', [
            'title' => 'Mon profil',
            'user' => $user,
        ], 'member');
    }

    public function updateProfile(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token de sécurité invalide.');
            $this->redirect(APP_URL . '/profile');
        }

        $userId = Auth::id();
        $user = $this->userModel->findById($userId);

        $firstName = trim($this->input('first_name', ''));
        $lastName = trim($this->input('last_name', ''));
        $currentPassword = $this->input('current_password', '');
        $newPassword = $this->input('new_password', '');
        $confirmPassword = $this->input('confirm_password', '');

        $errors = [];

        if (!$firstName || !$lastName) {
            $errors[] = 'Le nom et le prénom sont obligatoires.';
        }

        $updateData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
        ];

        if (!empty($_FILES['avatar']['name'])) {

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {

                $errors[] = 'Format d’image invalide.';

            } else {

                $extension = pathinfo(
                    $_FILES['avatar']['name'],
                    PATHINFO_EXTENSION
                );

                $fileName = 'avatar_' . $userId . '_' . time() . '.' . $extension;

                $uploadPath = ROOT_PATH . '/public/uploads/avatars/' . $fileName;

                if (move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    $uploadPath
                )) {

                    $updateData['avatar'] = $fileName;

                } else {

                    $errors[] = 'Impossible de téléverser l’image.';
                }
            }
        }

        if ($newPassword) {

            $fullUser = $this->userModel->findByIdWithPassword($userId);

            if (
                !$fullUser ||
                !password_verify($currentPassword, $fullUser['password'])
            ) {
                $errors[] = 'Mot de passe actuel incorrect.';
            }

            if (strlen($newPassword) < 8) {
                $errors[] = 'Le nouveau mot de passe doit contenir au moins 8 caractères.';
            }

            if ($newPassword !== $confirmPassword) {
                $errors[] = 'Les nouveaux mots de passe ne correspondent pas.';
            }

            if (!$errors) {
                $updateData['password'] = password_hash(
                    $newPassword,
                    PASSWORD_DEFAULT
                );
            }
        }

        if ($errors) {

            $this->view('user/profile', [
                'title' => 'Mon profil',
                'user' => array_merge($user, [
                    'first_name' => $firstName,
                    'last_name' => $lastName
                ]),
                'errors' => $errors,
            ], 'member');

            return;
        }

        $this->userModel->update($userId, $updateData);

        $_SESSION['user_name'] = $firstName . ' ' . $lastName;

        $this->flash('success', 'Profil mis à jour avec succès.');

        $this->redirect(APP_URL . '/profile');
    }
}