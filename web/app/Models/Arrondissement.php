<?php
require_once __DIR__ . '/Database.php';

class Arrondissement {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        return $this->db->query('SELECT * FROM arrondissements ORDER BY libelle')->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare('SELECT * FROM arrondissements WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare('INSERT INTO arrondissements (libelle) VALUES (:libelle)');
        return $stmt->execute([':libelle' => $data['libelle']]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('UPDATE arrondissements SET libelle = :libelle WHERE id = :id');
        return $stmt->execute([':libelle' => $data['libelle'], ':id' => $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM arrondissements WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
