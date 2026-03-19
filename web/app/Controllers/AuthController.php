<?php

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'يرجى إدخال اسم المستخدم وكلمة المرور';
            } else {
                $user = $this->userModel->findByUsername($username);
                if ($user && $this->userModel->verifyPassword($password, $user['password_hash'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['username']  = $user['username'];
                    $_SESSION['role']      = $user['role'];
                    header('Location: index.php?page=dashboard');
                    exit;
                }
                $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
            }
        }

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }

    public function changePassword(): void
    {
        $error   = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();

            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword     = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $user = $this->userModel->findByUsername($_SESSION['username']);

            if (!$this->userModel->verifyPassword($currentPassword, $user['password_hash'])) {
                $error = 'كلمة المرور الحالية غير صحيحة';
            } elseif (strlen($newPassword) < 6) {
                $error = 'يجب أن تكون كلمة المرور الجديدة 6 أحرف على الأقل';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'كلمة المرور الجديدة غير متطابقة';
            } else {
                $this->userModel->updatePassword($_SESSION['user_id'], $newPassword);
                $success = 'تم تغيير كلمة المرور بنجاح';
            }
        }

        require __DIR__ . '/../Views/auth/change_password.php';
    }

    private function verifyCsrf(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            exit('طلب غير صالح');
        }
    }
}
