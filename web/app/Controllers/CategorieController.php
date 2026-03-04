<?php
require_once __DIR__ . '/../Models/Categorie.php';

class CategorieController {
    private Categorie $model;

    public function __construct() {
        $this->model = new Categorie();
    }

    public function index(): void {
        $categories = $this->model->getAll();
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/categories/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function create(): void {
        $categorie = ['id' => null, 'libelle' => '', 'montant' => 0];
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? ''), 'montant' => (float)($_POST['montant'] ?? 0)];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->create($data)) {
                header('Location: index.php?page=categories');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/categories/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function edit(int $id): void {
        $categorie = $this->model->getById($id);
        if (!$categorie) { header('Location: index.php?page=categories'); exit; }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? ''), 'montant' => (float)($_POST['montant'] ?? 0)];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->update($id, $data)) {
                header('Location: index.php?page=categories');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/categories/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=categories');
        exit;
    }
}
