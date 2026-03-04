<?php

namespace App\Models;

use PDO;

class Adresse
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db->query(
            'SELECT a.*, ar.LibArr FROM adresses a
             LEFT JOIN arrondissements ar ON a.arrondissement_id = ar.id
             ORDER BY a.LibAdr'
        )->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT a.*, ar.LibArr FROM adresses a
             LEFT JOIN arrondissements ar ON a.arrondissement_id = ar.id
             WHERE a.CodeAdr = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO adresses (LibAdr, arrondissement_id) VALUES (:LibAdr, :arrondissement_id)'
        );
        $stmt->execute([
            ':LibAdr'            => $data['LibAdr'],
            ':arrondissement_id' => $data['arrondissement_id'] ?: null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE adresses SET LibAdr = :LibAdr, arrondissement_id = :arrondissement_id WHERE CodeAdr = :id'
        );
        return $stmt->execute([
            ':LibAdr'            => $data['LibAdr'],
            ':arrondissement_id' => $data['arrondissement_id'] ?: null,
            ':id'                => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM adresses WHERE CodeAdr = :id');
        return $stmt->execute([':id' => $id]);
    }
}
