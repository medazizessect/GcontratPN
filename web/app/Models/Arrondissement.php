<?php

namespace App\Models;

use PDO;

class Arrondissement
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM arrondissements ORDER BY LibArr')->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM arrondissements WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO arrondissements (LibArr) VALUES (:LibArr)');
        $stmt->execute([':LibArr' => $data['LibArr']]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE arrondissements SET LibArr = :LibArr WHERE id = :id');
        return $stmt->execute([':LibArr' => $data['LibArr'], ':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM arrondissements WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
