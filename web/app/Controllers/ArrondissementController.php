<?php
require_once __DIR__ . '/../Models/Arrondissement.php';

class ArrondissementController {
    private Arrondissement $model;

    public function __construct() {
        $this->model = new Arrondissement();
    }

    public function index(): void {
        $arrondissements = $this->model->getAll();
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/arrondissements/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function create(): void {
        $arrondissement = ['id' => null, 'libelle' => ''];
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->create($data)) {
                header('Location: index.php?page=arrondissements');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/arrondissements/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function edit(int $id): void {
        $arrondissement = $this->model->getById($id);
        if (!$arrondissement) { header('Location: index.php?page=arrondissements'); exit; }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->update($id, $data)) {
                header('Location: index.php?page=arrondissements');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/arrondissements/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=arrondissements');
        exit;
    }
}
