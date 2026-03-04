<?php
/**
 * GcontratPN — Point d'entrée et routeur principal
 * PHP 8.1+ MVC Application
 */

declare(strict_types=1);

// Autoloader Composer
require_once __DIR__ . '/vendor/autoload.php';

// Démarrage de session sécurisée
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true,
]);

// Génération du token CSRF s'il n'existe pas
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Pages accessibles sans authentification
$publicPages = ['login'];

$page   = $_GET['page']   ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id     = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Protection des routes
if (!in_array($page, $publicPages, true) && empty($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

// Redirections si déjà connecté
if ($page === 'login' && !empty($_SESSION['user_id'])) {
    header('Location: index.php?page=dashboard');
    exit;
}

use App\Controllers\AuthController;
use App\Controllers\ContratController;
use App\Controllers\ActiviteController;
use App\Controllers\AdresseController;
use App\Controllers\ArrondissementController;
use App\Controllers\CategorieController;
use App\Controllers\RapportController;
use App\Models\Contrat;

// Routage
try {
    if ($page === 'login') {
        (new AuthController())->login();
    } elseif ($page === 'auth') {
        $ctrl = new AuthController();
        match ($action) {
            'logout'          => $ctrl->logout(),
            'change_password' => $ctrl->changePassword(),
            default           => $ctrl->login(),
        };
    } elseif ($page === 'dashboard') {
        $contratModel = new Contrat();
        require __DIR__ . '/app/Views/layouts/header.php';
        require __DIR__ . '/app/Views/dashboard/index.php';
        require __DIR__ . '/app/Views/layouts/footer.php';
    } elseif ($page === 'contrats') {
        $ctrl = new ContratController();
        match ($action) {
            'create'   => $ctrl->create(),
            'edit'     => $ctrl->edit($id ?? 0),
            'show'     => $ctrl->show($id ?? 0),
            'delete'   => $ctrl->delete($id ?? 0),
            'imprimer' => $ctrl->imprimer($id ?? 0),
            default    => $ctrl->index(),
        };
    } elseif ($page === 'activites') {
        $ctrl = new ActiviteController();
        match ($action) {
            'create' => $ctrl->create(),
            'edit'   => $ctrl->edit($id ?? 0),
            'delete' => $ctrl->delete($id ?? 0),
            default  => $ctrl->index(),
        };
    } elseif ($page === 'adresses') {
        $ctrl = new AdresseController();
        match ($action) {
            'create' => $ctrl->create(),
            'edit'   => $ctrl->edit($id ?? 0),
            'delete' => $ctrl->delete($id ?? 0),
            default  => $ctrl->index(),
        };
    } elseif ($page === 'arrondissements') {
        $ctrl = new ArrondissementController();
        match ($action) {
            'create' => $ctrl->create(),
            'edit'   => $ctrl->edit($id ?? 0),
            'delete' => $ctrl->delete($id ?? 0),
            default  => $ctrl->index(),
        };
    } elseif ($page === 'categories') {
        $ctrl = new CategorieController();
        match ($action) {
            'create' => $ctrl->create(),
            'edit'   => $ctrl->edit($id ?? 0),
            'delete' => $ctrl->delete($id ?? 0),
            default  => $ctrl->index(),
        };
    } elseif ($page === 'rapports') {
        $ctrl = new RapportController();
        match ($action) {
            'contrat', 'imprimer_contrat' => $ctrl->imprimerContrat($id ?? 0),
            'liste'                       => $ctrl->listeContrats($_GET),
            'stats', 'statistiques'       => $ctrl->statistiques($_GET['annee'] ?? ''),
            default                       => $ctrl->listeContrats([]),
        };
    } else {
        http_response_code(404);
        require __DIR__ . '/app/Views/layouts/header.php';
        echo '<div class="alert alert-warning text-center mt-5"><h4>404 — الصفحة غير موجودة</h4></div>';
        require __DIR__ . '/app/Views/layouts/footer.php';
    }
} catch (\Throwable $e) {
    http_response_code(500);
    if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<pre style="color:red;padding:20px;">';
        echo htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "\n";
        echo htmlspecialchars($e->getTraceAsString(), ENT_QUOTES, 'UTF-8');
        echo '</pre>';
    } else {
        echo '<div style="text-align:center;padding:50px;font-family:sans-serif;">
               <h3>حدث خطأ، يرجى المحاولة مجدداً</h3>
              </div>';
    }
}
