<?php

namespace App\Models;

use PDO;

class Activite
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM activites ORDER BY LibAct')->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM activites WHERE CodeAct = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO activites (LibAct) VALUES (:LibAct)');
        $stmt->execute([':LibAct' => $data['LibAct']]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE activites SET LibAct = :LibAct WHERE CodeAct = :id');
        return $stmt->execute([':LibAct' => $data['LibAct'], ':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM activites WHERE CodeAct = :id');
        return $stmt->execute([':id' => $id]);
    }
}
