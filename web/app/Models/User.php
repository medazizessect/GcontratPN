<?php
require_once __DIR__ . '/Database.php';

class User {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsername(string $username): array|false {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }

    public function verifyPassword(string $password, string $storedPassword): bool {
        return $password === $storedPassword;
    }

    public function updatePassword(int $id, string $newPassword): bool {
        $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE id = :id');
        return $stmt->execute([':password' => $newPassword, ':id' => $id]);
    }
}
