<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    private function verifyCsrf(): void {
        if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(403);
            exit('CSRF token invalide');
        }
    }

    public function login(): void {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            if ($username === '' || $password === '') {
                $error = 'يرجى إدخال اسم المستخدم وكلمة المرور';
            } else {
                $user = $this->userModel->findByUsername($username);
                if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    header('Location: index.php?page=dashboard');
                    exit;
                }
                $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
            }
        }
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }

    public function changePassword(): void {
        $error   = '';
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword     = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $user = $this->userModel->findByUsername($_SESSION['username'] ?? '');
            if (!$user || !$this->userModel->verifyPassword($currentPassword, $user['password'])) {
                $error = 'كلمة المرور الحالية غير صحيحة';
            } elseif ($newPassword === '') {
                $error = 'كلمة المرور الجديدة لا يمكن أن تكون فارغة';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'كلمة المرور الجديدة غير متطابقة';
            } else {
                $this->userModel->updatePassword((int)$user['id'], $newPassword);
                $success = 'تم تغيير كلمة المرور بنجاح';
            }
        }
        require __DIR__ . '/../Views/auth/change_password.php';
    }
}
