<?php

namespace App\Controllers;

use App\Models\Activite;

class ActiviteController
{
    private Activite $model;

    public function __construct()
    {
        $this->model = new Activite();
    }

    public function index(): void
    {
        $activites = $this->model->getAll();
        require __DIR__ . '/../Views/activites/index.php';
    }

    public function create(): void
    {
        $errors = [];
        $data   = ['LibAct' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibAct' => trim($_POST['LibAct'] ?? '')];

            if ($data['LibAct'] === '') {
                $errors[] = 'اسم النشاط مطلوب';
            } else {
                $this->model->create($data);
                header('Location: index.php?page=activites&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/activites/create.php';
    }

    public function edit(int $id): void
    {
        $activite = $this->model->getById($id);
        if (!$activite) {
            http_response_code(404);
            exit('النشاط غير موجود');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = ['LibAct' => trim($_POST['LibAct'] ?? '')];

            if ($data['LibAct'] === '') {
                $errors[] = 'اسم النشاط مطلوب';
            } else {
                $this->model->update($id, $data);
                header('Location: index.php?page=activites&msg=updated');
                exit;
            }
            $activite['LibAct'] = $data['LibAct'];
        }

        require __DIR__ . '/../Views/activites/edit.php';
    }

    public function delete(int $id): void
    {
        $this->verifyCsrf();
        $this->model->delete($id);
        header('Location: index.php?page=activites&msg=deleted');
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
