<?php
require_once __DIR__ . '/../Models/Contrat.php';
require_once __DIR__ . '/../Models/Activite.php';
require_once __DIR__ . '/../Models/Adresse.php';
require_once __DIR__ . '/../Models/Arrondissement.php';
require_once __DIR__ . '/../Models/Categorie.php';

class ContratController {
    private Contrat $model;

    public function __construct() {
        $this->model = new Contrat();
    }

    public function index(): void {
        $search  = trim($_GET['search'] ?? '');
        $page    = max(1, (int)($_GET['p'] ?? 1));
        $perPage = 10;
        $contrats = $this->model->getAll($page, $perPage, $search);
        $total    = $this->model->countAll($search);
        $pages    = (int)ceil($total / $perPage);
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/contrats/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function create(): void {
        $activites      = (new Activite())->getAll();
        $adresses       = (new Adresse())->getAll();
        $arrondissements = (new Arrondissement())->getAll();
        $categories     = (new Categorie())->getAll();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractData();
            if ($this->model->create($data)) {
                header('Location: index.php?page=contrats');
                exit;
            }
            $error = 'حدث خطأ أثناء الحفظ';
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/contrats/create.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function edit(int $id): void {
        $contrat = $this->model->getById($id);
        if (!$contrat) { header('Location: index.php?page=contrats'); exit; }
        $activites       = (new Activite())->getAll();
        $adresses        = (new Adresse())->getAll();
        $arrondissements = (new Arrondissement())->getAll();
        $categories      = (new Categorie())->getAll();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extractData();
            if ($this->model->update($id, $data)) {
                header('Location: index.php?page=contrats');
                exit;
            }
            $error = 'حدث خطأ أثناء الحفظ';
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/contrats/edit.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function show(int $id): void {
        $contrat = $this->model->getById($id);
        if (!$contrat) { header('Location: index.php?page=contrats'); exit; }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/contrats/show.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=contrats');
        exit;
    }

    public function imprimer(int $id): void {
        $contrat = $this->model->getById($id);
        if (!$contrat) { header('Location: index.php?page=contrats'); exit; }
        require __DIR__ . '/../Views/rapports/contrat.php';
    }

    private function extractData(): array {
        return [
            ':num_contrat'       => trim($_POST['num_contrat'] ?? ''),
            ':nom'               => trim($_POST['nom'] ?? ''),
            ':prenom'            => trim($_POST['prenom'] ?? ''),
            ':cin'               => trim($_POST['cin'] ?? ''),
            ':telephone'         => trim($_POST['telephone'] ?? ''),
            ':adresse_id'        => ($_POST['adresse_id'] ?? '') !== '' ? (int)$_POST['adresse_id'] : null,
            ':arrondissement_id' => ($_POST['arrondissement_id'] ?? '') !== '' ? (int)$_POST['arrondissement_id'] : null,
            ':activite_id'       => ($_POST['activite_id'] ?? '') !== '' ? (int)$_POST['activite_id'] : null,
            ':categorie_id'      => ($_POST['categorie_id'] ?? '') !== '' ? (int)$_POST['categorie_id'] : null,
            ':date_contrat'      => ($_POST['date_contrat'] ?? '') ?: null,
            ':date_debut'        => ($_POST['date_debut'] ?? '') ?: null,
            ':date_fin'          => ($_POST['date_fin'] ?? '') ?: null,
            ':montant'           => (float)($_POST['montant'] ?? 0),
            ':montant_paye'      => (float)($_POST['montant_paye'] ?? 0),
            ':observation'       => trim($_POST['observation'] ?? ''),
            ':statut'            => in_array($_POST['statut'] ?? '', ['signed', 'unsigned']) ? $_POST['statut'] : 'unsigned',
        ];
    }
}
