<?php

namespace App\Models;

use PDO;

class Categorie
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db->query('SELECT * FROM categories ORDER BY LibCat')->fetchAll();
    }

    public function findById(string $code): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE CodeCat = :code');
        $stmt->execute([':code' => $code]);
        return $stmt->fetch();
    }

    /** @deprecated Use findById() */
    public function getById(string $code): array|false
    {
        return $this->findById($code);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO categories (CodeCat, LibCat, Decre, MontMet, MontMetClo, MontAff, NomPresident)
             VALUES (:CodeCat, :LibCat, :Decre, :MontMet, :MontMetClo, :MontAff, :NomPresident)'
        );
        return $stmt->execute($this->sanitize($data));
    }

    public function update(string $code, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE categories SET
             LibCat = :LibCat, Decre = :Decre, MontMet = :MontMet,
             MontMetClo = :MontMetClo, MontAff = :MontAff, NomPresident = :NomPresident
             WHERE CodeCat = :CodeCat'
        );
        $params = $this->sanitize($data);
        $params[':CodeCat'] = $code;
        return $stmt->execute($params);
    }

    public function delete(string $code): bool
    {
        $stmt = $this->db->prepare('DELETE FROM categories WHERE CodeCat = :code');
        return $stmt->execute([':code' => $code]);
    }

    private function sanitize(array $data): array
    {
        return [
            ':CodeCat'      => $data['CodeCat']      ?? null,
            ':LibCat'       => $data['LibCat']        ?? null,
            ':Decre'        => $data['Decre']         !== '' ? ($data['Decre'] ?? null) : null,
            ':MontMet'      => $data['MontMet']       !== '' ? ($data['MontMet'] ?? null) : null,
            ':MontMetClo'   => $data['MontMetClo']    !== '' ? ($data['MontMetClo'] ?? null) : null,
            ':MontAff'      => $data['MontAff']       !== '' ? ($data['MontAff'] ?? null) : null,
            ':NomPresident' => $data['NomPresident']  !== '' ? ($data['NomPresident'] ?? null) : null,
        ];
    }
}
