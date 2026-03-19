# Installation de GcontratPN Web

## Prérequis

- PHP 8.1+
- MySQL 5.7+ ou MariaDB 10+
- XAMPP / WAMP / Hébergement PHP standard
- **Aucune commande `composer` nécessaire**

## Étapes d'installation

### 1. Copier les fichiers
Placer le dossier `web/` dans `htdocs/GcontratP/web/` (XAMPP) ou équivalent.

### 2. Créer la base de données
```sql
CREATE DATABASE gcontrat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Puis importer : `web/migrations/create_database.sql`

### 3. Configurer la base de données
Modifier `web/config/database.php` avec vos identifiants MySQL.

### 4. Installer TCPDF (pour la génération PDF)
a) Télécharger depuis https://github.com/tecnickcom/TCPDF/releases  
b) Extraire et copier le contenu dans `web/lib/tcpdf/`  
c) Vérifier que `web/lib/tcpdf/tcpdf.php` existe

### 5. Accéder à l'application
http://localhost/GcontratP/web/

### Identifiants par défaut
- Utilisateur : `admin`
- Mot de passe : `admin123`

(À changer immédiatement après la première connexion)
