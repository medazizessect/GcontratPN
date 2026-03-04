<?php
require_once __DIR__ . '/Database.php';

class Contrat {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(int $page = 1, int $perPage = 10, string $search = ''): array {
        $offset = ($page - 1) * $perPage;
        $params = [];
        $where = '';
        if ($search !== '') {
            $where = "WHERE c.num_contrat LIKE :s OR c.nom LIKE :s OR c.prenom LIKE :s OR c.cin LIKE :s";
            $params[':s'] = '%' . $search . '%';
        }
        $sql = "SELECT c.*, act.libelle AS activite_libelle, adr.libelle AS adresse_libelle,
                       arr.libelle AS arrondissement_libelle, cat.libelle AS categorie_libelle
                FROM contrats c
                LEFT JOIN activites act ON c.activite_id = act.id
                LEFT JOIN adresses adr ON c.adresse_id = adr.id
                LEFT JOIN arrondissements arr ON c.arrondissement_id = arr.id
                LEFT JOIN categories cat ON c.categorie_id = cat.id
                $where
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v);
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(string $search = ''): int {
        $params = [];
        $where = '';
        if ($search !== '') {
            $where = "WHERE num_contrat LIKE :s OR nom LIKE :s OR prenom LIKE :s OR cin LIKE :s";
            $params[':s'] = '%' . $search . '%';
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM contrats $where");
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare(
            "SELECT c.*, act.libelle AS activite_libelle, adr.libelle AS adresse_libelle,
                    arr.libelle AS arrondissement_libelle, cat.libelle AS categorie_libelle
             FROM contrats c
             LEFT JOIN activites act ON c.activite_id = act.id
             LEFT JOIN adresses adr ON c.adresse_id = adr.id
             LEFT JOIN arrondissements arr ON c.arrondissement_id = arr.id
             LEFT JOIN categories cat ON c.categorie_id = cat.id
             WHERE c.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO contrats (num_contrat, nom, prenom, cin, telephone, adresse_id, arrondissement_id,
             activite_id, categorie_id, date_contrat, date_debut, date_fin, montant, montant_paye, observation, statut)
             VALUES (:num_contrat, :nom, :prenom, :cin, :telephone, :adresse_id, :arrondissement_id,
             :activite_id, :categorie_id, :date_contrat, :date_debut, :date_fin, :montant, :montant_paye, :observation, :statut)"
        );
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool {
        $data[':id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE contrats SET num_contrat=:num_contrat, nom=:nom, prenom=:prenom, cin=:cin,
             telephone=:telephone, adresse_id=:adresse_id, arrondissement_id=:arrondissement_id,
             activite_id=:activite_id, categorie_id=:categorie_id, date_contrat=:date_contrat,
             date_debut=:date_debut, date_fin=:date_fin, montant=:montant, montant_paye=:montant_paye,
             observation=:observation, statut=:statut WHERE id=:id"
        );
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM contrats WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function countBySigned(): array {
        $stmt = $this->db->query("SELECT statut, COUNT(*) AS total FROM contrats GROUP BY statut");
        $rows = $stmt->fetchAll();
        $result = ['signed' => 0, 'unsigned' => 0];
        foreach ($rows as $row) {
            $result[$row['statut']] = (int) $row['total'];
        }
        return $result;
    }

    public function countThisMonth(): int {
        $stmt = $this->db->query(
            "SELECT COUNT(*) FROM contrats WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())"
        );
        return (int) $stmt->fetchColumn();
    }
}
