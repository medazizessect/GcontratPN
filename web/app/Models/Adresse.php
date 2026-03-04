<?php
require_once __DIR__ . '/Database.php';

class Adresse {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        return $this->db->query('SELECT * FROM adresses ORDER BY libelle')->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare('SELECT * FROM adresses WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare('INSERT INTO adresses (libelle) VALUES (:libelle)');
        return $stmt->execute([':libelle' => $data['libelle']]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('UPDATE adresses SET libelle = :libelle WHERE id = :id');
        return $stmt->execute([':libelle' => $data['libelle'], ':id' => $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM adresses WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
