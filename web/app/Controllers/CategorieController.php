<?php

namespace App\Controllers;

use App\Models\Categorie;

class CategorieController
{
    private Categorie $model;

    public function __construct()
    {
        $this->model = new Categorie();
    }

    public function index(): void
    {
        $categories = $this->model->getAll();
        require __DIR__ . '/../Views/categories/index.php';
    }

    public function create(): void
    {
        $errors = [];
        $data   = ['LibCat' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibCat' => trim($_POST['LibCat'] ?? '')];

            if ($data['LibCat'] === '') {
                $errors[] = 'اسم الفئة مطلوب';
            } else {
                $this->model->create($data);
                header('Location: index.php?page=categories&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/categories/create.php';
    }

    public function edit(int $id): void
    {
        $categorie = $this->model->getById($id);
        if (!$categorie) {
            http_response_code(404);
            exit('الفئة غير موجودة');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibCat' => trim($_POST['LibCat'] ?? '')];

            if ($data['LibCat'] === '') {
                $errors[] = 'اسم الفئة مطلوب';
            } else {
                $this->model->update($id, $data);
                header('Location: index.php?page=categories&msg=updated');
                exit;
            }
            $categorie['LibCat'] = $data['LibCat'];
        }

        require __DIR__ . '/../Views/categories/edit.php';
    }

    public function delete(int $id): void
    {
        $this->verifyCsrf();
        $this->model->delete($id);
        header('Location: index.php?page=categories&msg=deleted');
        exit;
    }

    private function verifyCsrf(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            exit('طلب غير صالح');
        }
    }
}
