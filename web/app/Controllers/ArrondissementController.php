<?php

namespace App\Controllers;

use App\Models\Arrondissement;

class ArrondissementController
{
    private Arrondissement $model;

    public function __construct()
    {
        $this->model = new Arrondissement();
    }

    public function index(): void
    {
        $arrondissements = $this->model->getAll();
        require __DIR__ . '/../Views/arrondissements/index.php';
    }

    public function create(): void
    {
        $errors = [];
        $data   = ['LibArr' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibArr' => trim($_POST['LibArr'] ?? '')];

            if ($data['LibArr'] === '') {
                $errors[] = 'اسم الدائرة مطلوب';
            } else {
                $this->model->create($data);
                header('Location: index.php?page=arrondissements&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/arrondissements/create.php';
    }

    public function edit(int $id): void
    {
        $arrondissement = $this->model->getById($id);
        if (!$arrondissement) {
            http_response_code(404);
            exit('الدائرة غير موجودة');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibArr' => trim($_POST['LibArr'] ?? '')];

            if ($data['LibArr'] === '') {
                $errors[] = 'اسم الدائرة مطلوب';
            } else {
                $this->model->update($id, $data);
                header('Location: index.php?page=arrondissements&msg=updated');
                exit;
            }
            $arrondissement['LibArr'] = $data['LibArr'];
        }

        require __DIR__ . '/../Views/arrondissements/edit.php';
    }

    public function delete(int $id): void
    {
        $this->verifyCsrf();
        $this->model->delete($id);
        header('Location: index.php?page=arrondissements&msg=deleted');
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
