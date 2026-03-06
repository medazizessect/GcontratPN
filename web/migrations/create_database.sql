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

-- Table categories (CodeCat VARCHAR PK, correspond à la table Categorie SQL Server)
CREATE TABLE IF NOT EXISTS `categories` (
    `CodeCat` VARCHAR(10) NOT NULL,
    `LibCat` VARCHAR(50) NOT NULL,
    `Decre` VARCHAR(50) DEFAULT NULL,
    `MontMet` DECIMAL(15,3) DEFAULT NULL,
    `MontMetClo` DECIMAL(15,3) DEFAULT NULL,
    `MontAff` DECIMAL(15,3) DEFAULT NULL,
    `NomPresident` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`CodeCat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table contrats (correspond à la table Fiche SQL Server)
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
    `CodeCat` VARCHAR(10) DEFAULT NULL,
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
    CONSTRAINT `fk_contrats_adresse` FOREIGN KEY (`CodeAdr`) REFERENCES `adresses`(`CodeAdr`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_contrats_categorie` FOREIGN KEY (`CodeCat`) REFERENCES `categories`(`CodeCat`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─── Données de démo ────────────────────────────────────────────────────────

-- Utilisateur admin par défaut (mot de passe: admin123)
INSERT INTO `users` (`username`, `password_hash`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Arrondissements
INSERT INTO `arrondissements` (`LibArr`) VALUES
('المدينة العتيقة'),
('باب الجديد'),
('حي النصر'),
('الزهور'),
('سيدي منصور');

-- Activités
INSERT INTO `activites` (`LibAct`) VALUES
('بناء وأشغال عمومية'),
('تجارة عامة'),
('صناعة غذائية'),
('خدمات معلوماتية'),
('نقل وشحن'),
('زراعة وري'),
('صيانة وإصلاح'),
('سياحة وفندقة');

-- Adresses
INSERT INTO `adresses` (`LibAdr`, `arrondissement_id`) VALUES
('شارع الحرية', 1),
('شارع بورقيبة', 2),
('حي الأمل', 3),
('طريق السفاريس', 4),
('المنطقة الصناعية', 5),
('شارع 20 مارس', 1),
('حي التضامن', 3);

-- Catégories
INSERT INTO `categories` (`CodeCat`, `LibCat`, `Decre`, `MontMet`, `MontMetClo`, `MontAff`, `NomPresident`) VALUES
('CAT01', 'الفئة الأولى', 'مرسوم 2020-100', 50000.000, 45000.000, 55000.000, 'محمد الأمين'),
('CAT02', 'الفئة الثانية', 'مرسوم 2020-101', 100000.000, 90000.000, 110000.000, 'علي بن يوسف'),
('CAT03', 'الفئة الثالثة', 'مرسوم 2021-045', 200000.000, 180000.000, 220000.000, 'فاطمة الزهراء'),
('CAT04', 'الفئة الرابعة', 'مرسوم 2021-046', 500000.000, 450000.000, 550000.000, 'خالد المنصوري'),
('CAT05', 'الفئة الخامسة', 'مرسوم 2022-012', 1000000.000, 950000.000, 1050000.000, 'سمير الحداد');

-- Contrats de démo
INSERT INTO `contrats`
  (`Numero`, `nom`, `CIN`, `Telephone`, `MatriculeFis`, `NomCom`, `CodeAct`, `CodeAdr`, `CodeCat`,
   `DateD`, `DateSignature`, `Signature`, `DateRetour`, `Retour`,
   `DateEnr`, `NumeroEnr`, `MontantEnr`, `ValidEnr`,
   `AnneeExc`, `MontantExc`, `Quantite`, `NbrJour`, `NumOrd`, `NomPresident`, `observation`)
VALUES
('C-2024-001', 'أحمد بن سالم', '12345678', '22123456', 'MF001234', 'شركة النور', 1, 1, 'CAT02',
 '2024-01-15', '2024-01-20', 1, NULL, 0,
 '2024-02-01', 'ENR-001', 95000.000, 1,
 2024, 100000.000, 50.000, 30, 'ORD-001', 'محمد الأمين', 'عقد بناء مبنى إداري'),

('C-2024-002', 'فاطمة بن عمر', '87654321', '55987654', 'MF005678', 'مؤسسة الإخلاص', 2, 2, 'CAT01',
 '2024-02-10', NULL, 0, NULL, 0,
 NULL, NULL, NULL, 0,
 2024, 48000.000, 100.000, 60, NULL, 'علي بن يوسف', 'عقد تجاري تجريبي'),

('C-2024-003', 'كريم المنصوري', '11223344', '98765432', 'MF009012', 'شركة التقدم', 3, 3, 'CAT03',
 '2024-03-05', '2024-03-10', 1, '2024-04-15', 1,
 '2024-03-20', 'ENR-003', 185000.000, 1,
 2024, 200000.000, 200.000, 45, 'ORD-003', 'فاطمة الزهراء', 'توريد مواد غذائية'),

('C-2024-004', 'سعاد الطرابلسي', '44332211', '71234567', 'MF003456', 'مكتب الحلول', 4, 4, 'CAT01',
 '2024-04-20', '2024-04-25', 1, NULL, 0,
 '2024-05-01', 'ENR-004', 47000.000, 1,
 2024, 52000.000, 1.000, 20, 'ORD-004', 'محمد الأمين', 'تطوير منظومة معلوماتية'),

('C-2024-005', 'نور الدين الفارسي', '55667788', '33445566', 'MF007890', 'مجموعة النقل', 5, 5, 'CAT02',
 '2024-05-12', NULL, 0, NULL, 0,
 NULL, NULL, NULL, 0,
 2024, 90000.000, 10.000, 15, NULL, 'علي بن يوسف', 'عقد نقل البضائع'),

('C-2024-006', 'ليلى بن صالح', '99887766', '44556677', 'MF011234', 'مزرعة الأمل', 6, 6, 'CAT01',
 '2024-06-01', '2024-06-05', 1, '2024-07-10', 1,
 '2024-06-20', 'ENR-006', 46500.000, 1,
 2024, 48000.000, 500.000, 90, 'ORD-006', 'محمد الأمين', 'مشروع ري وزراعة'),

('C-2024-007', 'عمر الرشيدي', '33221100', '66778899', 'MF015678', 'ورشة الصيانة', 7, 7, 'CAT01',
 '2024-07-15', '2024-07-18', 1, NULL, 0,
 '2024-08-01', 'ENR-007', 28000.000, 0,
 2024, 32000.000, 1.000, 10, 'ORD-007', 'خالد المنصوري', 'صيانة المعدات'),

('C-2025-001', 'مريم الكريمي', '22334455', '77889900', 'MF019012', 'فندق النجوم', 8, 1, 'CAT03',
 '2025-01-10', '2025-01-15', 1, NULL, 0,
 '2025-01-25', 'ENR-2025-001', 192000.000, 1,
 2025, 200000.000, 1.000, 365, 'ORD-2025-001', 'فاطمة الزهراء', 'عقد إدارة فندق'),

('C-2025-002', 'يوسف الغانمي', '66554433', '11223344', 'MF023456', 'شركة البناء الحديث', 1, 2, 'CAT04',
 '2025-02-01', NULL, 0, NULL, 0,
 NULL, NULL, NULL, 0,
 2025, 480000.000, 1.000, 180, NULL, 'خالد المنصوري', 'مشروع بناء سكني'),

('C-2025-003', 'حنان العمري', '88997766', '99001122', 'MF027890', 'مركز التدريب', 4, 3, 'CAT02',
 '2025-03-01', '2025-03-05', 1, NULL, 0,
 NULL, NULL, NULL, 0,
 2025, 98000.000, 1.000, 60, NULL, 'علي بن يوسف', 'عقد تدريب وتكوين');
