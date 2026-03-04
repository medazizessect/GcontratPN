<?php
/**
 * Configuration de la base de données
 * GcontratPN - Application Web PHP 8 + MySQL
 */

return [
    'host'     => $_ENV['DB_HOST']     ?? 'localhost',
    'port'     => $_ENV['DB_PORT']     ?? '3306',
    'dbname'   => $_ENV['DB_NAME']     ?? 'gcontrat_pn',
    'username' => $_ENV['DB_USER']     ?? 'root',
    'password' => $_ENV['DB_PASS']     ?? '',
    'charset'  => 'utf8mb4',
    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ],
];
