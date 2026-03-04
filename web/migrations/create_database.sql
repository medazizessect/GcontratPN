-- GcontratPN - Script SQL complet MySQL
-- Encodage: utf8mb4

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET time_zone = '+00:00';

CREATE DATABASE IF NOT EXISTS `gcontrat_pn` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gcontrat_pn`;

-- Table users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` ENUM('admin','user') NOT NULL DEFAULT 'user',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table arrondissements
CREATE TABLE IF NOT EXISTS `arrondissements` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `LibArr` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table activites
CREATE TABLE IF NOT EXISTS `activites` (
    `CodeAct` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `LibAct` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table adresses
CREATE TABLE IF NOT EXISTS `adresses` (
    `CodeAdr` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `LibAdr` VARCHAR(255) NOT NULL,
    `arrondissement_id` INT UNSIGNED NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_adresses_arrondissement` FOREIGN KEY (`arrondissement_id`) REFERENCES `arrondissements`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table categories
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `LibCat` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table contrats
CREATE TABLE IF NOT EXISTS `contrats` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `Numero` VARCHAR(50) NOT NULL,
    `nom` VARCHAR(50) NOT NULL,
    `CIN` VARCHAR(10) DEFAULT NULL,
    `Telephone` VARCHAR(10) DEFAULT NULL,
    `MatriculeFis` VARCHAR(50) DEFAULT NULL,
    `NomCom` VARCHAR(15) DEFAULT NULL,
    `CodeAct` INT UNSIGNED DEFAULT NULL,
    `CodeAdr` INT UNSIGNED DEFAULT NULL,
    `DateD` DATE DEFAULT NULL,
    `DateSignature` DATE DEFAULT NULL,
    `Signature` TINYINT(1) NOT NULL DEFAULT 0,
    `DateRetour` DATE DEFAULT NULL,
    `Retour` TINYINT(1) NOT NULL DEFAULT 0,
    `DateEnr` DATE DEFAULT NULL,
    `NumeroEnr` VARCHAR(50) DEFAULT NULL,
    `MontantEnr` DECIMAL(15,3) DEFAULT NULL,
    `ValidEnr` TINYINT(1) NOT NULL DEFAULT 0,
    `AnneeExc` DECIMAL(4,0) DEFAULT NULL,
    `MontantExc` DECIMAL(15,3) DEFAULT NULL,
    `Quantite` DECIMAL(15,3) DEFAULT NULL,
    `MontantAnn` DECIMAL(15,3) DEFAULT NULL,
    `NbrJour` DECIMAL(5,0) DEFAULT NULL,
    `MontantLit` DECIMAL(15,3) DEFAULT NULL,
    `NumOrd` VARCHAR(50) DEFAULT NULL,
    `NomPresident` VARCHAR(100) DEFAULT NULL,
    `observation` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT `fk_contrats_activite` FOREIGN KEY (`CodeAct`) REFERENCES `activites`(`CodeAct`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_contrats_adresse` FOREIGN KEY (`CodeAdr`) REFERENCES `adresses`(`CodeAdr`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Utilisateur admin par défaut (mot de passe: admin123)
INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
