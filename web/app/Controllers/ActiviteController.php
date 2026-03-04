<?php
require_once __DIR__ . '/../Models/Activite.php';

class ActiviteController {
    private Activite $model;

    public function __construct() {
        $this->model = new Activite();
    }

    public function index(): void {
        $activites = $this->model->getAll();
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/activites/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function create(): void {
        $activite = ['id' => null, 'libelle' => ''];
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->create($data)) {
                header('Location: index.php?page=activites');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/activites/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function edit(int $id): void {
        $activite = $this->model->getById($id);
        if (!$activite) { header('Location: index.php?page=activites'); exit; }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->update($id, $data)) {
                header('Location: index.php?page=activites');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/activites/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=activites');
        exit;
    }
}
