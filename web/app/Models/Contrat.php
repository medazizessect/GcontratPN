<?php

namespace App\Models;

use PDO;

class Contrat
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contrats');
        return (int) $stmt->fetchColumn();
    }

    public function getAll(int $limit = 100, int $offset = 0): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, a.LibAct, adr.LibAdr
             FROM contrats c
             LEFT JOIN activites a ON c.CodeAct = a.CodeAct
             LEFT JOIN adresses adr ON c.CodeAdr = adr.CodeAdr
             ORDER BY c.created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, a.LibAct, adr.LibAdr
             FROM contrats c
             LEFT JOIN activites a ON c.CodeAct = a.CodeAct
             LEFT JOIN adresses adr ON c.CodeAdr = adr.CodeAdr
             WHERE c.id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function search(array $filters, int $limit = 100, int $offset = 0): array
    {
        $where = [];
        $params = [];

        if (!empty($filters['Numero'])) {
            $where[] = 'c.Numero LIKE :Numero';
            $params[':Numero'] = '%' . $filters['Numero'] . '%';
        }
        if (!empty($filters['nom'])) {
            $where[] = 'c.nom LIKE :nom';
            $params[':nom'] = '%' . $filters['nom'] . '%';
        }
        if (!empty($filters['CIN'])) {
            $where[] = 'c.CIN LIKE :CIN';
            $params[':CIN'] = '%' . $filters['CIN'] . '%';
        }
        if (isset($filters['Signature']) && $filters['Signature'] !== '') {
            $where[] = 'c.Signature = :Signature';
            $params[':Signature'] = (int) $filters['Signature'];
        }
        if (!empty($filters['DateD_from'])) {
            $where[] = 'c.DateD >= :DateD_from';
            $params[':DateD_from'] = $filters['DateD_from'];
        }
        if (!empty($filters['DateD_to'])) {
            $where[] = 'c.DateD <= :DateD_to';
            $params[':DateD_to'] = $filters['DateD_to'];
        }
        if (!empty($filters['AnneeExc'])) {
            $where[] = 'c.AnneeExc = :AnneeExc';
            $params[':AnneeExc'] = $filters['AnneeExc'];
        }

        $sql = 'SELECT c.*, a.LibAct, adr.LibAdr
                FROM contrats c
                LEFT JOIN activites a ON c.CodeAct = a.CodeAct
                LEFT JOIN adresses adr ON c.CodeAdr = adr.CodeAdr';

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= ' ORDER BY c.created_at DESC';

        $countSql = 'SELECT COUNT(*) FROM (' . $sql . ') sub';
        $countStmt = $this->db->prepare($countSql);
        $countStmt->execute($params);
        $total = (int) $countStmt->fetchColumn();

        $sql .= ' LIMIT :limit OFFSET :offset';
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return ['data' => $stmt->fetchAll(), 'total' => $total];
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO contrats
             (Numero, nom, CIN, Telephone, MatriculeFis, NomCom, CodeAct, CodeAdr,
              DateD, DateSignature, Signature, DateRetour, Retour,
              DateEnr, NumeroEnr, MontantEnr, ValidEnr,
              AnneeExc, MontantExc, Quantite, MontantAnn, NbrJour, MontantLit,
              NumOrd, NomPresident, observation)
             VALUES
             (:Numero, :nom, :CIN, :Telephone, :MatriculeFis, :NomCom, :CodeAct, :CodeAdr,
              :DateD, :DateSignature, :Signature, :DateRetour, :Retour,
              :DateEnr, :NumeroEnr, :MontantEnr, :ValidEnr,
              :AnneeExc, :MontantExc, :Quantite, :MontantAnn, :NbrJour, :MontantLit,
              :NumOrd, :NomPresident, :observation)'
        );
        $stmt->execute($this->sanitize($data));
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE contrats SET
             Numero=:Numero, nom=:nom, CIN=:CIN, Telephone=:Telephone,
             MatriculeFis=:MatriculeFis, NomCom=:NomCom, CodeAct=:CodeAct, CodeAdr=:CodeAdr,
             DateD=:DateD, DateSignature=:DateSignature, Signature=:Signature,
             DateRetour=:DateRetour, Retour=:Retour,
             DateEnr=:DateEnr, NumeroEnr=:NumeroEnr, MontantEnr=:MontantEnr, ValidEnr=:ValidEnr,
             AnneeExc=:AnneeExc, MontantExc=:MontantExc, Quantite=:Quantite,
             MontantAnn=:MontantAnn, NbrJour=:NbrJour, MontantLit=:MontantLit,
             NumOrd=:NumOrd, NomPresident=:NomPresident, observation=:observation
             WHERE id=:id'
        );
        $params = $this->sanitize($data);
        $params[':id'] = $id;
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM contrats WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function countTotal(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contrats');
        return (int) $stmt->fetchColumn();
    }

    public function countBySigned(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contrats WHERE Signature = 1');
        return (int) $stmt->fetchColumn();
    }

    public function countByRegistered(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contrats WHERE ValidEnr = 1');
        return (int) $stmt->fetchColumn();
    }

    public function countByReturned(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contrats WHERE Retour = 1');
        return (int) $stmt->fetchColumn();
    }

    public function sumMontantEnr(): float
    {
        $stmt = $this->db->query('SELECT COALESCE(SUM(MontantEnr), 0) FROM contrats WHERE ValidEnr = 1');
        return (float) $stmt->fetchColumn();
    }

    public function countByYear(): array
    {
        $stmt = $this->db->query(
            'SELECT AnneeExc AS annee, COUNT(*) AS total
             FROM contrats
             WHERE AnneeExc IS NOT NULL
             GROUP BY AnneeExc
             ORDER BY AnneeExc DESC
             LIMIT 5'
        );
        return $stmt->fetchAll();
    }

    public function countByActivite(int $limit = 5): array
    {
        $stmt = $this->db->prepare(
            'SELECT a.LibAct, COUNT(c.id) AS total
             FROM contrats c
             JOIN activites a ON c.CodeAct = a.CodeAct
             GROUP BY c.CodeAct, a.LibAct
             ORDER BY total DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countByMonthCurrentYear(): array
    {
        $stmt = $this->db->query(
            'SELECT MONTH(created_at) AS mois, COUNT(*) AS total
             FROM contrats
             WHERE YEAR(created_at) = YEAR(NOW())
             GROUP BY MONTH(created_at)
             ORDER BY mois'
        );
        return $stmt->fetchAll();
    }

    public function countByArrondissement(int $limit = 5): array
    {
        $stmt = $this->db->prepare(
            'SELECT arr.LibArr, COUNT(c.id) AS total
             FROM contrats c
             JOIN adresses adr ON c.CodeAdr = adr.CodeAdr
             JOIN arrondissements arr ON adr.arrondissement_id = arr.id
             GROUP BY arr.id, arr.LibArr
             ORDER BY total DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecent(int $limit = 10): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.id, c.Numero, c.nom, c.DateD, c.Signature, c.MontantEnr
             FROM contrats c
             ORDER BY c.created_at DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countThisMonth(): int
    {
        $stmt = $this->db->query(
            'SELECT COUNT(*) FROM contrats
             WHERE YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())'
        );
        return (int) $stmt->fetchColumn();
    }

    public function statsByArrondissement(string $annee = ''): array
    {
        $sql = 'SELECT arr.LibArr,
                       COUNT(c.id) AS total,
                       COALESCE(SUM(c.MontantEnr), 0) AS sumMontantEnr,
                       COALESCE(SUM(c.MontantExc), 0) AS sumMontantExc
                FROM contrats c
                JOIN adresses adr ON c.CodeAdr = adr.CodeAdr
                JOIN arrondissements arr ON adr.arrondissement_id = arr.id';
        $params = [];
        if ($annee !== '') {
            $sql .= ' WHERE c.AnneeExc = :annee';
            $params[':annee'] = $annee;
        }
        $sql .= ' GROUP BY arr.id, arr.LibArr ORDER BY total DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getAvailableYears(): array
    {
        $stmt = $this->db->query(
            'SELECT DISTINCT AnneeExc FROM contrats
             WHERE AnneeExc IS NOT NULL
             ORDER BY AnneeExc DESC'
        );
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function sanitize(array $data): array
    {
        $fields = [
            'Numero', 'nom', 'CIN', 'Telephone', 'MatriculeFis', 'NomCom',
            'CodeAct', 'CodeAdr', 'DateD', 'DateSignature', 'Signature',
            'DateRetour', 'Retour', 'DateEnr', 'NumeroEnr', 'MontantEnr',
            'ValidEnr', 'AnneeExc', 'MontantExc', 'Quantite', 'MontantAnn',
            'NbrJour', 'MontantLit', 'NumOrd', 'NomPresident', 'observation',
        ];
        $params = [];
        foreach ($fields as $field) {
            $value = $data[$field] ?? null;
            // Convert empty strings to null for numeric/date fields
            if ($value === '') {
                $value = null;
            }
            $params[':' . $field] = $value;
        }
        return $params;
    }
}
