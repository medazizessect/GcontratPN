<?php
require_once __DIR__ . '/../Models/Adresse.php';

class AdresseController {
    private Adresse $model;

    public function __construct() {
        $this->model = new Adresse();
    }

    public function index(): void {
        $adresses = $this->model->getAll();
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/adresses/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function create(): void {
        $adresse = ['id' => null, 'libelle' => ''];
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->create($data)) {
                header('Location: index.php?page=adresses');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/adresses/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function edit(int $id): void {
        $adresse = $this->model->getById($id);
        if (!$adresse) { header('Location: index.php?page=adresses'); exit; }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['libelle' => trim($_POST['libelle'] ?? '')];
            if ($data['libelle'] === '') { $error = 'الحقل مطلوب'; }
            elseif ($this->model->update($id, $data)) {
                header('Location: index.php?page=adresses');
                exit;
            } else { $error = 'حدث خطأ أثناء الحفظ'; }
        }
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/adresses/_form.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=adresses');
        exit;
    }
}
