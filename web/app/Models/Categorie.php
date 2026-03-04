<?php
require_once __DIR__ . '/Database.php';

class Categorie {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        return $this->db->query('SELECT * FROM categories ORDER BY libelle')->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare('INSERT INTO categories (libelle, montant) VALUES (:libelle, :montant)');
        return $stmt->execute([':libelle' => $data['libelle'], ':montant' => $data['montant'] ?? 0]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('UPDATE categories SET libelle = :libelle, montant = :montant WHERE id = :id');
        return $stmt->execute([':libelle' => $data['libelle'], ':montant' => $data['montant'] ?? 0, ':id' => $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
