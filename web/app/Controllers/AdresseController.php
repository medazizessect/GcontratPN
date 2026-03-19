<?php

namespace App\Controllers;

use App\Models\Adresse;
use App\Models\Arrondissement;

class AdresseController
{
    private Adresse $model;
    private Arrondissement $arrModel;

    public function __construct()
    {
        $this->model    = new Adresse();
        $this->arrModel = new Arrondissement();
    }

    public function index(): void
    {
        $adresses = $this->model->getAll();
        require __DIR__ . '/../Views/adresses/index.php';
    }

    public function create(): void
    {
        $arrondissements = $this->arrModel->getAll();
        $errors = [];
        $data   = ['LibAdr' => '', 'arrondissement_id' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = [
                'LibAdr'            => trim($_POST['LibAdr'] ?? ''),
                'arrondissement_id' => $_POST['arrondissement_id'] ?? '',
            ];

            if ($data['LibAdr'] === '') {
                $errors[] = 'العنوان مطلوب';
            } else {
                $this->model->create($data);
                header('Location: index.php?page=adresses&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/adresses/create.php';
    }

    public function edit(int $id): void
    {
        $adresse         = $this->model->getById($id);
        $arrondissements = $this->arrModel->getAll();

        if (!$adresse) {
            http_response_code(404);
            exit('العنوان غير موجود');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = [
                'LibAdr'            => trim($_POST['LibAdr'] ?? ''),
                'arrondissement_id' => $_POST['arrondissement_id'] ?? '',
            ];

            if ($data['LibAdr'] === '') {
                $errors[] = 'العنوان مطلوب';
            } else {
                $this->model->update($id, $data);
                header('Location: index.php?page=adresses&msg=updated');
                exit;
            }
            $adresse = array_merge($adresse, $data);
        }

        require __DIR__ . '/../Views/adresses/edit.php';
    }

    public function delete(int $id): void
    {
        $this->verifyCsrf();
        $this->model->delete($id);
        header('Location: index.php?page=adresses&msg=deleted');
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
