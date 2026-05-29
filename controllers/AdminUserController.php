<?php

class AdminUserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(): void
    {
        $search = trim($this->input('q', ''));
        $users = $this->userModel->all($search);

        $this->view('admin/users/index', [
            'title' => 'Gestion des utilisateurs',
            'users' => $users,
            'search' => $search,
        ], 'admin');
    }

    public function create(): void
    {
        $this->view('admin/users/form', [
            'title' => 'Créer un utilisateur',
            'user' => null,
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token invalide.');
            $this->redirect(APP_URL . '/admin/users/create');
        }

        $data = $this->validateUserForm();
        if (isset($data['errors'])) {
            $this->view('admin/users/form', [
                'title' => 'Créer un utilisateur',
                'user' => $data['old'],
                'errors' => $data['errors'],
            ], 'admin');
            return;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->userModel->create($data);

        $this->flash('success', 'Utilisateur créé.');
        $this->redirect(APP_URL . '/admin/users');
    }

    public function show(string $id): void
    {
        $user = $this->userModel->findById((int) $id);
        if (!$user) {
            $this->flash('danger', 'Utilisateur introuvable.');
            $this->redirect(APP_URL . '/admin/users');
        }

        $this->view('admin/users/show', [
            'title' => 'Détail utilisateur',
            'user' => $user,
        ], 'admin');
    }

    public function edit(string $id): void
    {
        $user = $this->userModel->findById((int) $id);
        if (!$user) {
            $this->flash('danger', 'Utilisateur introuvable.');
            $this->redirect(APP_URL . '/admin/users');
        }

        $this->view('admin/users/form', [
            'title' => 'Modifier un utilisateur',
            'user' => $user,
        ], 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token invalide.');
            $this->redirect(APP_URL . '/admin/users/' . $id . '/edit');
        }

        $userId = (int) $id;
        $existing = $this->userModel->findById($userId);
        if (!$existing) {
            $this->flash('danger', 'Utilisateur introuvable.');
            $this->redirect(APP_URL . '/admin/users');
        }

        $data = $this->validateUserForm($userId, false);
        if (isset($data['errors'])) {
            $this->view('admin/users/form', [
                'title' => 'Modifier un utilisateur',
                'user' => array_merge($existing, $data['old']),
                'errors' => $data['errors'],
            ], 'admin');
            return;
        }

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $this->userModel->update($userId, $data);
        $this->flash('success', 'Utilisateur mis à jour.');
        $this->redirect(APP_URL . '/admin/users');
    }

    public function delete(string $id): void
    {
        if (!$this->verifyCsrf()) {
            $this->error403();
        }

        $userId = (int) $id;
        if ($userId === Auth::id()) {
            $this->flash('danger', 'Vous ne pouvez pas supprimer votre propre compte.');
            $this->redirect(APP_URL . '/admin/users');
        }

        $this->userModel->delete($userId);
        $this->flash('success', 'Utilisateur supprimé.');
        $this->redirect(APP_URL . '/admin/users');
    }

    private function validateUserForm(?int $excludeId = null, bool $passwordRequired = true): array
    {
        $firstName = trim($this->input('first_name', ''));
        $lastName = trim($this->input('last_name', ''));
        $username = trim($this->input('username', ''));
        $email = trim($this->input('email', ''));
        $password = $this->input('password', '');
        $role = $this->input('role', 'user');

        $errors = [];
        $old = compact('firstName', 'lastName', 'username', 'email', 'role');
        $old = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $email,
            'role' => in_array($role, ['user', 'admin']) ? $role : 'user',
        ];

        if (!$firstName || !$lastName || !$username || !$email) {
            $errors[] = 'Tous les champs obligatoires doivent être remplis.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        }

        if ($this->userModel->usernameExists($username, $excludeId)) {
            $errors[] = 'Nom d\'utilisateur déjà utilisé.';
        }

        if ($this->userModel->emailExists($email, $excludeId)) {
            $errors[] = 'Email déjà utilisé.';
        }

        if ($passwordRequired && strlen($password) < 8) {
            $errors[] = 'Mot de passe requis (8 caractères minimum).';
        } elseif ($password && strlen($password) < 8) {
            $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        if ($errors) {
            return ['errors' => $errors, 'old' => $old];
        }

        $result = $old;
        if ($password) {
            $result['password'] = $password;
        }

        return $result;
    }
}

