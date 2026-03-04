<?php
declare(strict_types=1);

// Démarrage de session sécurisé
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
    ]);
}

// Chargement manuel des classes (sans Composer)
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

// Routeur simple
$page   = $_GET['page']   ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Vérification authentification (sauf login)
if ($page !== 'auth' && empty($_SESSION['user_id'])) {
    header('Location: ?page=auth&action=login');
    exit;
}

// Dispatch
try {
switch ($page) {
    case 'auth':
        $ctrl = new AuthController();
        if ($action === 'login')  { $ctrl->login();  break; }
        if ($action === 'logout') { $ctrl->logout(); break; }
        if ($action === 'change_password') { $ctrl->changePassword(); break; }
        break;

    case 'contrats':
        $ctrl = new ContratController();
        if ($action === 'index')  { $ctrl->index();         break; }
        if ($action === 'create') { $ctrl->create();        break; }
        if ($action === 'edit')   { $ctrl->edit($id);       break; }
        if ($action === 'show')   { $ctrl->show($id);       break; }
        if ($action === 'delete') { $ctrl->delete($id);     break; }
        break;

    case 'activites':
        $ctrl = new ActiviteController();
        if ($action === 'index')  { $ctrl->index();         break; }
        if ($action === 'create') { $ctrl->create();        break; }
        if ($action === 'edit')   { $ctrl->edit($id);       break; }
        if ($action === 'delete') { $ctrl->delete($id);     break; }
        break;

    case 'adresses':
        $ctrl = new AdresseController();
        if ($action === 'index')  { $ctrl->index();         break; }
        if ($action === 'create') { $ctrl->create();        break; }
        if ($action === 'edit')   { $ctrl->edit($id);       break; }
        if ($action === 'delete') { $ctrl->delete($id);     break; }
        break;

    case 'arrondissements':
        $ctrl = new ArrondissementController();
        if ($action === 'index')  { $ctrl->index();         break; }
        if ($action === 'create') { $ctrl->create();        break; }
        if ($action === 'edit')   { $ctrl->edit($id);       break; }
        if ($action === 'delete') { $ctrl->delete($id);     break; }
        break;

    case 'categories':
        $ctrl = new CategorieController();
        if ($action === 'index')  { $ctrl->index();         break; }
        if ($action === 'create') { $ctrl->create();        break; }
        if ($action === 'edit')   { $ctrl->edit($id);       break; }
        if ($action === 'delete') { $ctrl->delete($id);     break; }
        break;

    case 'rapports':
        $ctrl = new RapportController();
        if ($action === 'imprimer_contrat') { $ctrl->imprimerContrat($id); break; }
        if ($action === 'liste')            { $ctrl->listeContrats();      break; }
        if ($action === 'statistiques')     { $ctrl->statistiques();       break; }
        break;

    case 'dashboard':
    default:
        require_once __DIR__ . '/app/Views/dashboard/index.php';
        break;
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
