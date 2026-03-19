<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Singleton PDO pour la connexion MySQL
 */
class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['dbname'],
            $config['charset']
        );

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        } catch (PDOException $e) {
            throw new PDOException('Erreur de connexion à la base de données: ' . $e->getMessage());
        }
    }

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    // Empêcher le clonage et la désérialisation
    private function __clone() {}
    public function __wakeup(): void
    {
        throw new \Exception('Cannot unserialize singleton');
    }
}
