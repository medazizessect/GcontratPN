# GcontratPN — Application Web PHP 8 + MySQL

Migration de l'application VB6 de gestion de contrats vers une application web PHP 8 + MySQL en architecture MVC.

## Prérequis

- PHP 8.1 ou supérieur (avec extensions : pdo, pdo_mysql, mbstring)
- MySQL 5.7+ ou MariaDB 10.4+
- Composer
- Serveur web Apache/Nginx (ou PHP built-in server pour développement)

## Installation

### 1. Installer les dépendances PHP

```bash
cd web/
composer install
```

### 2. Configurer la base de données

Copier et éditer la configuration :

```bash
# Modifier web/config/database.php avec vos paramètres
# ou utiliser des variables d'environnement :
export DB_HOST=localhost
export DB_PORT=3306
export DB_NAME=gcontrat_pn
export DB_USER=votre_utilisateur
export DB_PASS=votre_mot_de_passe
```

### 3. Créer la base de données MySQL

```bash
mysql -u root -p < migrations/create_database.sql
```

Ou depuis MySQL :
```sql
SOURCE /chemin/vers/web/migrations/create_database.sql;
```

### 4. Configurer le serveur web

#### Apache (.htaccess à placer dans web/)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

#### Développement local (PHP built-in server)

```bash
cd web/
php -S localhost:8000
```

Puis ouvrir http://localhost:8000/index.php

### 5. Connexion par défaut

| Champ | Valeur |
|-------|--------|
| Utilisateur | `admin` |
| Mot de passe | `admin123` |

⚠️ **Changer le mot de passe immédiatement après la première connexion !**

## Structure du projet

```
web/
├── index.php                    # Routeur principal
├── composer.json                # Dépendances (dompdf/dompdf)
├── config/
│   └── database.php             # Configuration PDO MySQL
├── app/
│   ├── Controllers/             # Logique métier
│   │   ├── AuthController.php
│   │   ├── ContratController.php
│   │   ├── ActiviteController.php
│   │   ├── AdresseController.php
│   │   ├── ArrondissementController.php
│   │   ├── CategorieController.php
│   │   └── RapportController.php
│   ├── Models/                  # Accès données (PDO)
│   │   ├── Database.php
│   │   ├── Contrat.php
│   │   ├── Activite.php
│   │   ├── Adresse.php
│   │   ├── Arrondissement.php
│   │   ├── Categorie.php
│   │   └── User.php
│   └── Views/                   # Templates PHP
│       ├── layouts/
│       ├── auth/
│       ├── dashboard/
│       ├── contrats/
│       ├── activites/
│       ├── adresses/
│       ├── arrondissements/
│       └── categories/
├── migrations/
│   └── create_database.sql      # Script SQL complet
└── public/
    ├── css/style.css
    └── js/app.js
```

## Fonctionnalités

- ✅ Authentification sécurisée (sessions PHP, bcrypt)
- ✅ CSRF protection sur tous les formulaires POST
- ✅ CRUD complet pour les contrats (tous les champs VB6)
- ✅ CRUD pour Activités, Adresses, Arrondissements, Catégories
- ✅ Recherche et filtrage des contrats
- ✅ Pagination
- ✅ Génération PDF (DomPDF) : contrat individuel, liste, statistiques
- ✅ Interface RTL arabe (Bootstrap 5 RTL)
- ✅ Dashboard avec statistiques
- ✅ Requêtes PDO préparées (protection injection SQL)
- ✅ Encodage utf8mb4 complet

## Sécurité

- Mots de passe hashés avec `password_hash()` (bcrypt)
- Requêtes SQL préparées uniquement (PDO)
- Protection CSRF sur tous les formulaires POST
- `htmlspecialchars()` sur toutes les sorties
- Sessions sécurisées (httponly, samesite)

## Correspondance VB6 → PHP

| Formulaire VB6 | Équivalent PHP |
|---|---|
| PremEcr.frm | Views/auth/login.php |
| MotPasse.frm + MotP.frm | AuthController + change_password.php |
| Menu.frm | Views/dashboard/index.php |
| FFiche.frm | Views/contrats/create.php + edit.php |
| GFiche.frm | Views/contrats/index.php |
| CFiche.frm | Intégré dans contrats/index.php |
| FActivite.frm + GActivite.frm | Views/activites/ |
| FAdresse.frm + GAdresse.frm | Views/adresses/ |
| FArrondissement.frm + GArrondissement.frm | Views/arrondissements/ |
| FCategorie.frm + GCategorie.frm | Views/categories/ |
| Contrat.rpt + Contrat-2023.rpt | RapportController::imprimerContrat() |
| ListeContrat.rpt | RapportController::listeContrats() |
| Stat-Contrat.rpt | RapportController::statistiques() |
