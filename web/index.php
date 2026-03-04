<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/Models/Database.php';
require_once __DIR__ . '/app/Models/User.php';
require_once __DIR__ . '/app/Models/Contrat.php';
require_once __DIR__ . '/app/Models/Activite.php';
require_once __DIR__ . '/app/Models/Adresse.php';
require_once __DIR__ . '/app/Models/Arrondissement.php';
require_once __DIR__ . '/app/Models/Categorie.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/ContratController.php';
require_once __DIR__ . '/app/Controllers/ActiviteController.php';
require_once __DIR__ . '/app/Controllers/AdresseController.php';
require_once __DIR__ . '/app/Controllers/ArrondissementController.php';
require_once __DIR__ . '/app/Controllers/CategorieController.php';
require_once __DIR__ . '/app/Controllers/RapportController.php';

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode'  => true,
]);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$page   = $_GET['page']   ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

$publicPages = ['login'];

if (!in_array($page, $publicPages, true) && empty($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}
if ($page === 'login' && !empty($_SESSION['user_id'])) {
    header('Location: index.php?page=dashboard');
    exit;
}

try {
    switch ($page) {
        case 'login':
            (new AuthController())->login();
            break;
        case 'auth':
            $ctrl = new AuthController();
            if ($action === 'logout') $ctrl->logout();
            elseif ($action === 'change_password') $ctrl->changePassword();
            else $ctrl->login();
            break;
        case 'dashboard':
            $contratModel = new Contrat();
            require __DIR__ . '/app/Views/layouts/header.php';
            require __DIR__ . '/app/Views/dashboard/index.php';
            require __DIR__ . '/app/Views/layouts/footer.php';
            break;
        case 'contrats':
            $ctrl = new ContratController();
            if ($action === 'create') $ctrl->create();
            elseif ($action === 'edit' && $id) $ctrl->edit($id);
            elseif ($action === 'show' && $id) $ctrl->show($id);
            elseif ($action === 'delete' && $id) $ctrl->delete($id);
            elseif ($action === 'imprimer' && $id) $ctrl->imprimer($id);
            else $ctrl->index();
            break;
        case 'activites':
            $ctrl = new ActiviteController();
            if ($action === 'create') $ctrl->create();
            elseif ($action === 'edit' && $id) $ctrl->edit($id);
            elseif ($action === 'delete' && $id) $ctrl->delete($id);
            else $ctrl->index();
            break;
        case 'adresses':
            $ctrl = new AdresseController();
            if ($action === 'create') $ctrl->create();
            elseif ($action === 'edit' && $id) $ctrl->edit($id);
            elseif ($action === 'delete' && $id) $ctrl->delete($id);
            else $ctrl->index();
            break;
        case 'arrondissements':
            $ctrl = new ArrondissementController();
            if ($action === 'create') $ctrl->create();
            elseif ($action === 'edit' && $id) $ctrl->edit($id);
            elseif ($action === 'delete' && $id) $ctrl->delete($id);
            else $ctrl->index();
            break;
        case 'categories':
            $ctrl = new CategorieController();
            if ($action === 'create') $ctrl->create();
            elseif ($action === 'edit' && $id) $ctrl->edit($id);
            elseif ($action === 'delete' && $id) $ctrl->delete($id);
            else $ctrl->index();
            break;
        case 'rapports':
            $ctrl = new RapportController();
            if ($action === 'contrat' && $id) $ctrl->contrat($id);
            elseif ($action === 'liste') $ctrl->liste();
            elseif ($action === 'statistiques') $ctrl->statistiques();
            else $ctrl->liste();
            break;
        default:
            http_response_code(404);
            echo '<h1>Page introuvable</h1>';
    }
} catch (Exception $e) {
    echo '<pre style="color:red">' . htmlspecialchars($e->getMessage()) . '</pre>';
}
