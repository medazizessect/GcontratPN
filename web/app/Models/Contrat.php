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

    /**
     * Liste paginée avec filtres.
     *
     * @param array $filters  Keys: Numero, nom, CIN, Signature, DateD_from, DateD_to, AnneeExc, CodeAct, CodeCat, Retour
     */
    public function getAll(array $filters = [], int $page = 1, int $perPage = 20): array
    {
        [$where, $params] = $this->buildWhere($filters);

        $sql = 'SELECT c.*, a.LibAct, adr.LibAdr, cat.LibCat
                FROM contrats c
                LEFT JOIN activites a   ON c.CodeAct = a.CodeAct
                LEFT JOIN adresses adr  ON c.CodeAdr = adr.CodeAdr
                LEFT JOIN categories cat ON c.CodeCat = cat.CodeCat';

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY c.created_at DESC';

        $offset = ($page - 1) * $perPage;
        $sql   .= ' LIMIT :limit OFFSET :offset';

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(array $filters = []): int
    {
        [$where, $params] = $this->buildWhere($filters);

        $sql = 'SELECT COUNT(*) FROM contrats c';
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, a.LibAct, adr.LibAdr, cat.LibCat
             FROM contrats c
             LEFT JOIN activites a    ON c.CodeAct = a.CodeAct
             LEFT JOIN adresses adr   ON c.CodeAdr = adr.CodeAdr
             LEFT JOIN categories cat ON c.CodeCat  = cat.CodeCat
             WHERE c.id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /** @deprecated Use findById() */
    public function getById(int $id): array|false
    {
        return $this->findById($id);
    }

    public function findByNumero(string $numero): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, a.LibAct, adr.LibAdr, cat.LibCat
             FROM contrats c
             LEFT JOIN activites a    ON c.CodeAct = a.CodeAct
             LEFT JOIN adresses adr   ON c.CodeAdr = adr.CodeAdr
             LEFT JOIN categories cat ON c.CodeCat  = cat.CodeCat
             WHERE c.Numero = :numero
             LIMIT 1'
        );
        $stmt->execute([':numero' => $numero]);
        return $stmt->fetch();
    }

    public function create(array $data): int|false
    {
        $stmt = $this->db->prepare(
            'INSERT INTO contrats
             (Numero, nom, CIN, Telephone, MatriculeFis, NomCom, CodeAct, CodeAdr, CodeCat,
              DateD, DateSignature, Signature, DateRetour, Retour,
              DateEnr, NumeroEnr, MontantEnr, ValidEnr,
              AnneeExc, MontantExc, Quantite, MontantAnn, NbrJour, MontantLit,
              NumOrd, NomPresident, observation)
             VALUES
             (:Numero, :nom, :CIN, :Telephone, :MatriculeFis, :NomCom, :CodeAct, :CodeAdr, :CodeCat,
              :DateD, :DateSignature, :Signature, :DateRetour, :Retour,
              :DateEnr, :NumeroEnr, :MontantEnr, :ValidEnr,
              :AnneeExc, :MontantExc, :Quantite, :MontantAnn, :NbrJour, :MontantLit,
              :NumOrd, :NomPresident, :observation)'
        );
        if (!$stmt->execute($this->sanitize($data))) {
            return false;
        }
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE contrats SET
             Numero=:Numero, nom=:nom, CIN=:CIN, Telephone=:Telephone,
             MatriculeFis=:MatriculeFis, NomCom=:NomCom, CodeAct=:CodeAct, CodeAdr=:CodeAdr, CodeCat=:CodeCat,
             DateD=:DateD, DateSignature=:DateSignature, Signature=:Signature,
             DateRetour=:DateRetour, Retour=:Retour,
             DateEnr=:DateEnr, NumeroEnr=:NumeroEnr, MontantEnr=:MontantEnr, ValidEnr=:ValidEnr,
             AnneeExc=:AnneeExc, MontantExc=:MontantExc, Quantite=:Quantite,
             MontantAnn=:MontantAnn, NbrJour=:NbrJour, MontantLit=:MontantLit,
             NumOrd=:NumOrd, NomPresident=:NomPresident, observation=:observation
             WHERE id=:id'
        );
        $params        = $this->sanitize($data);
        $params[':id'] = $id;
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM contrats WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Statistiques pour le dashboard.
     */
    public function getStats(): array
    {
        // Totaux globaux
        $row = $this->db->query(
            'SELECT
               COUNT(*)                                   AS total,
               SUM(Signature = 1)                         AS signes,
               SUM(Signature = 0)                         AS non_signes,
               SUM(ValidEnr  = 1)                         AS enregistres,
               SUM(Retour    = 0 AND Signature = 1)       AS en_cours,
               COALESCE(SUM(MontantEnr), 0)               AS montant_total
             FROM contrats'
        )->fetch();

        // Par activité (top 10)
        $parActivite = $this->db->query(
            'SELECT a.LibAct, COUNT(*) AS nb
             FROM contrats c
             LEFT JOIN activites a ON c.CodeAct = a.CodeAct
             GROUP BY c.CodeAct, a.LibAct
             ORDER BY nb DESC
             LIMIT 10'
        )->fetchAll();

        // Évolution mensuelle (12 derniers mois)
        $parMois = $this->db->query(
            'SELECT DATE_FORMAT(DateD, \'%Y-%m\') AS mois, COUNT(*) AS nb
             FROM contrats
             WHERE DateD >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
               AND DateD IS NOT NULL
             GROUP BY mois
             ORDER BY mois ASC'
        )->fetchAll();

        // Répartition par statut
        $parStatut = [
            ['statut' => 'موقّع',    'nb' => (int) ($row['signes']       ?? 0)],
            ['statut' => 'غير موقّع', 'nb' => (int) ($row['non_signes']   ?? 0)],
            ['statut' => 'مسجّل',    'nb' => (int) ($row['enregistres']   ?? 0)],
        ];

        // Alertes : contrats sans signature depuis plus de 30 jours
        $alertes = $this->db->query(
            'SELECT id, Numero, nom, DateD
             FROM contrats
             WHERE Signature = 0
               AND DateD IS NOT NULL
               AND DATEDIFF(CURDATE(), DateD) > 30
             ORDER BY DateD ASC
             LIMIT 10'
        )->fetchAll();

        return [
            'total'         => (int) ($row['total']         ?? 0),
            'signes'        => (int) ($row['signes']        ?? 0),
            'non_signes'    => (int) ($row['non_signes']    ?? 0),
            'enregistres'   => (int) ($row['enregistres']   ?? 0),
            'en_cours'      => (int) ($row['en_cours']      ?? 0),
            'montant_total' => (float) ($row['montant_total'] ?? 0),
            'par_activite'  => $parActivite,
            'par_mois'      => $parMois,
            'par_statut'    => $parStatut,
            'alertes'       => $alertes,
        ];
    }

    /**
     * Derniers contrats ajoutés.
     */
    public function getRecent(int $limit = 5): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, a.LibAct, adr.LibAdr, cat.LibCat
             FROM contrats c
             LEFT JOIN activites a    ON c.CodeAct = a.CodeAct
             LEFT JOIN adresses adr   ON c.CodeAdr = adr.CodeAdr
             LEFT JOIN categories cat ON c.CodeCat  = cat.CodeCat
             ORDER BY c.created_at DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ── Compatibility shims ──────────────────────────────────────────────────

    public function search(array $filters, int $limit = 100, int $offset = 0): array
    {
        [$where, $params] = $this->buildWhere($filters);

        $sql = 'SELECT c.*, a.LibAct, adr.LibAdr, cat.LibCat
                FROM contrats c
                LEFT JOIN activites a    ON c.CodeAct = a.CodeAct
                LEFT JOIN adresses adr   ON c.CodeAdr = adr.CodeAdr
                LEFT JOIN categories cat ON c.CodeCat  = cat.CodeCat';

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY c.created_at DESC';

        $countSql  = 'SELECT COUNT(*) FROM (' . $sql . ') sub';
        $countStmt = $this->db->prepare($countSql);
        $countStmt->execute($params);
        $total = (int) $countStmt->fetchColumn();

        $sql  .= ' LIMIT :limit OFFSET :offset';
        $stmt  = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit',  $limit,  PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return ['data' => $stmt->fetchAll(), 'total' => $total];
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

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function buildWhere(array $filters): array
    {
        $where  = [];
        $params = [];

        if (!empty($filters['Numero'])) {
            $where[]           = 'c.Numero LIKE :Numero';
            $params[':Numero'] = '%' . $filters['Numero'] . '%';
        }
        if (!empty($filters['nom'])) {
            $where[]        = 'c.nom LIKE :nom';
            $params[':nom'] = '%' . $filters['nom'] . '%';
        }
        if (!empty($filters['CIN'])) {
            $where[]        = 'c.CIN LIKE :CIN';
            $params[':CIN'] = '%' . $filters['CIN'] . '%';
        }
        if (isset($filters['Signature']) && $filters['Signature'] !== '') {
            $where[]               = 'c.Signature = :Signature';
            $params[':Signature']  = (int) $filters['Signature'];
        }
        if (isset($filters['Retour']) && $filters['Retour'] !== '') {
            $where[]           = 'c.Retour = :Retour';
            $params[':Retour'] = (int) $filters['Retour'];
        }
        if (!empty($filters['DateD_from'])) {
            $where[]                = 'c.DateD >= :DateD_from';
            $params[':DateD_from']  = $filters['DateD_from'];
        }
        if (!empty($filters['DateD_to'])) {
            $where[]              = 'c.DateD <= :DateD_to';
            $params[':DateD_to']  = $filters['DateD_to'];
        }
        if (!empty($filters['AnneeExc'])) {
            $where[]               = 'c.AnneeExc = :AnneeExc';
            $params[':AnneeExc']   = $filters['AnneeExc'];
        }
        if (!empty($filters['CodeAct'])) {
            $where[]             = 'c.CodeAct = :CodeAct';
            $params[':CodeAct']  = (int) $filters['CodeAct'];
        }
        if (!empty($filters['CodeCat'])) {
            $where[]             = 'c.CodeCat = :CodeCat';
            $params[':CodeCat']  = $filters['CodeCat'];
        }

        return [$where, $params];
    }

    private function sanitize(array $data): array
    {
        $fields = [
            'Numero', 'nom', 'CIN', 'Telephone', 'MatriculeFis', 'NomCom',
            'CodeAct', 'CodeAdr', 'CodeCat',
            'DateD', 'DateSignature', 'Signature',
            'DateRetour', 'Retour', 'DateEnr', 'NumeroEnr', 'MontantEnr',
            'ValidEnr', 'AnneeExc', 'MontantExc', 'Quantite', 'MontantAnn',
            'NbrJour', 'MontantLit', 'NumOrd', 'NomPresident', 'observation',
        ];
        $params = [];
        foreach ($fields as $field) {
            $value = $data[$field] ?? null;
            if ($value === '') {
                $value = null;
            }
            $params[':' . $field] = $value;
        }
        return $params;
    }
}
