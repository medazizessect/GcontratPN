<?php
require_once __DIR__ . '/../Models/Contrat.php';

class RapportController {
    private Contrat $model;

    public function __construct() {
        $this->model = new Contrat();
    }

    public function contrat(int $id): void {
        $contrat = $this->model->getById($id);
        if (!$contrat) {
            http_response_code(404);
            echo '<h1>العقد غير موجود</h1>';
            exit;
        }
        require __DIR__ . '/../Views/rapports/contrat.php';
    }

    public function liste(): void {
        $search   = trim($_GET['search'] ?? '');
        $contrats = $this->model->getAll(1, 1000, $search);
        require __DIR__ . '/../Views/rapports/liste.php';
    }

    public function statistiques(): void {
        $contrats = $this->model->getAll(1, 1000);
        $signed   = $this->model->countBySigned();
        $total    = $this->model->countAll();
        $thisMonth = $this->model->countThisMonth();
        require __DIR__ . '/../Views/rapports/statistiques.php';
    }
}
