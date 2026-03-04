CREATE DATABASE IF NOT EXISTS gcontrat_pn CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gcontrat_pn;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, role) VALUES ('admin', 'admin', 'admin');

CREATE TABLE IF NOT EXISTS activites (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS adresses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS arrondissements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(200) NOT NULL,
  montant DECIMAL(15,2) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS contrats (
  id INT AUTO_INCREMENT PRIMARY KEY,
  num_contrat VARCHAR(50),
  nom VARCHAR(100),
  prenom VARCHAR(100),
  cin VARCHAR(50),
  telephone VARCHAR(30),
  adresse_id INT,
  arrondissement_id INT,
  activite_id INT,
  categorie_id INT,
  date_contrat DATE,
  date_debut DATE,
  date_fin DATE,
  montant DECIMAL(15,2) DEFAULT 0,
  montant_paye DECIMAL(15,2) DEFAULT 0,
  observation TEXT,
  statut ENUM('signed','unsigned') DEFAULT 'unsigned',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (adresse_id) REFERENCES adresses(id) ON DELETE SET NULL,
  FOREIGN KEY (arrondissement_id) REFERENCES arrondissements(id) ON DELETE SET NULL,
  FOREIGN KEY (activite_id) REFERENCES activites(id) ON DELETE SET NULL,
  FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);
