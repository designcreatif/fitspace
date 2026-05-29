<?php

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function registerForm(): void
    {
        $this->view('auth/register', ['title' => 'Inscription']);
    }

    public function register(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token de sécurité invalide.');
            $this->redirect(APP_URL . '/register');
        }

        $firstName = trim($this->input('first_name', ''));
        $lastName = trim($this->input('last_name', ''));
        $username = trim($this->input('username', ''));
        $email = trim($this->input('email', ''));
        $password = $this->input('password', '');
        $passwordConfirm = $this->input('password_confirm', '');

        $errors = [];

        if (!$firstName || !$lastName || !$username || !$email || !$password) {
            $errors[] = 'Tous les champs sont obligatoires.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Adresse email invalide.';
        }

        if (strlen($username) < 3) {
            $errors[] = 'Le nom d\'utilisateur doit contenir au moins 3 caractères.';
        }

        if ($this->userModel->usernameExists($username)) {
            $errors[] = 'Ce nom d\'utilisateur est déjà pris.';
        }

        if ($this->userModel->emailExists($email)) {
            $errors[] = 'Cette adresse email est déjà utilisée.';
        }

        if (strlen($password) < 8) {
            $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        if ($password !== $passwordConfirm) {
            $errors[] = 'Les mots de passe ne correspondent pas.';
        }

        if ($errors) {
            $this->view('auth/register', [
                'title' => 'Inscription',
                'errors' => $errors,
                'old' => compact('firstName', 'lastName', 'username', 'email'),
            ]);
            return;
        }

        $this->userModel->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
        ]);

        $this->flash('success', 'Compte créé avec succès ! Vous pouvez vous connecter.');
        $this->redirect(APP_URL . '/login');
    }

    public function loginForm(): void
    {
        $this->view('auth/login', ['title' => 'Connexion']);
    }

    public function login(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token de sécurité invalide.');
            $this->redirect(APP_URL . '/login');
        }

        $login = trim($this->input('login', ''));
        $password = $this->input('password', '');

        if (!$login || !$password) {
            $this->view('auth/login', [
                'title' => 'Connexion',
                'error' => 'Veuillez remplir tous les champs.',
                'old_login' => $login,
            ]);
            return;
        }

        $user = $this->userModel->findByUsername($login)
            ?: $this->userModel->findByEmail($login);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->view('auth/login', [
                'title' => 'Connexion',
                'error' => 'Identifiants incorrects.',
                'old_login' => $login,
            ]);
            return;
        }

        Auth::login($user);

        $redirect = $_SESSION['redirect_after_login'] ?? null;
        unset($_SESSION['redirect_after_login']);

        if ($redirect) {
            $this->redirect($redirect);
        }

        if ($user['role'] === 'admin') {
            $this->redirect(APP_URL . '/admin');
        }

        $this->redirect(APP_URL . '/dashboard');
    }

    public function logout(): void
    {
        Auth::logout();
        session_start();
        $this->flash('success', 'Vous avez été déconnecté.');
        $this->redirect(APP_URL . '/');
    }

    public function forgotForm(): void
    {
        $this->view('auth/forgot', ['title' => 'Mot de passe oublié']);
    }

    public function forgot(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token de sécurité invalide.');
            $this->redirect(APP_URL . '/forgot-password');
        }

        $email = trim($this->input('email', ''));
        $user = $this->userModel->findByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', time() + RESET_TOKEN_EXPIRY);
            $this->userModel->setResetToken($user['id'], $token, $expires);

            $resetLink = APP_URL . '/reset-password?token=' . $token;

            if (!is_dir(ROOT_PATH . '/storage')) {
                mkdir(ROOT_PATH . '/storage', 0755, true);
            }
            $log = date('Y-m-d H:i:s') . " - Reset pour {$email}: {$resetLink}\n";
            file_put_contents(ROOT_PATH . '/storage/reset_links.log', $log, FILE_APPEND);
        }

        $this->view('auth/forgot', [
            'title' => 'Mot de passe oublié',
            'sent' => true,
            'message' => 'Si cette adresse existe, un lien de réinitialisation a été envoyé. Vérifiez également le fichier storage/reset_links.log en développement.',
        ]);
    }

    public function resetForm(): void
    {
        $token = $this->input('token', '');
        $user = $token ? $this->userModel->findByResetToken($token) : null;

        if (!$user) {
            $this->flash('danger', 'Lien invalide ou expiré.');
            $this->redirect(APP_URL . '/forgot-password');
        }

        $this->view('auth/reset', [
            'title' => 'Réinitialiser le mot de passe',
            'token' => $token,
        ]);
    }

    public function reset(): void
    {
        if (!$this->verifyCsrf()) {
            $this->flash('danger', 'Token de sécurité invalide.');
            $this->redirect(APP_URL . '/forgot-password');
        }

        $token = $this->input('token', '');
        $password = $this->input('password', '');
        $passwordConfirm = $this->input('password_confirm', '');

        $user = $this->userModel->findByResetToken($token);

        if (!$user) {
            $this->flash('danger', 'Lien invalide ou expiré.');
            $this->redirect(APP_URL . '/forgot-password');
        }

        if (strlen($password) < 8 || $password !== $passwordConfirm) {
            $this->view('auth/reset', [
                'title' => 'Réinitialiser le mot de passe',
                'token' => $token,
                'error' => 'Le mot de passe doit contenir au moins 8 caractères et être identique à la confirmation.',
            ]);
            return;
        }

        $this->userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        $this->userModel->clearResetToken($user['id']);

        $this->flash('success', 'Mot de passe mis à jour. Vous pouvez vous connecter.');
        $this->redirect(APP_URL . '/login');
    }
}

