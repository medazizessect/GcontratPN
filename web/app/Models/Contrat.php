<?php

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

    public function countBySigned(): array
    {
        $stmt = $this->db->query(
            'SELECT
               SUM(Signature = 1) AS signes,
               SUM(Signature = 0) AS non_signes
             FROM contrats'
        );
        return $stmt->fetch();
    }

    public function countThisMonth(): int
    {
        $stmt = $this->db->query(
            'SELECT COUNT(*) FROM contrats
             WHERE YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())'
        );
        return (int) $stmt->fetchColumn();
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
