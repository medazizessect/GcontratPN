<?php

namespace App\Models;

use PDO;

class Categorie
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM categories ORDER BY LibCat')->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO categories (LibCat) VALUES (:LibCat)');
        $stmt->execute([':LibCat' => $data['LibCat']]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE categories SET LibCat = :LibCat WHERE id = :id');
        return $stmt->execute([':LibCat' => $data['LibCat'], ':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
