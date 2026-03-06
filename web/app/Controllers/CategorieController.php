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
        $data   = $this->emptyData();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data   = $this->getPostData();
            $errors = $this->validate($data, true);

            if (empty($errors)) {
                $this->model->create($data);
                header('Location: index.php?page=categories&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/categories/create.php';
    }

    public function edit(string $code = ''): void
    {
        $categorie = $this->model->findById($code);
        if (!$categorie) {
            http_response_code(404);
            exit('الفئة غير موجودة');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data   = $this->getPostData();
            $errors = $this->validate($data, false);

            if (empty($errors)) {
                $this->model->update($code, $data);
                header('Location: index.php?page=categories&msg=updated');
                exit;
            }
            $categorie = array_merge($categorie, $data);
        }

        require __DIR__ . '/../Views/categories/edit.php';
    }

    public function delete(): void
    {
        $this->verifyCsrf();
        $code = trim($_POST['CodeCat'] ?? '');
        if ($code !== '') {
            $this->model->delete($code);
        }
        header('Location: index.php?page=categories&msg=deleted');
        exit;
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function getPostData(): array
    {
        return [
            'CodeCat'      => strtoupper(trim($_POST['CodeCat']      ?? '')),
            'LibCat'       => trim($_POST['LibCat']       ?? ''),
            'Decre'        => trim($_POST['Decre']        ?? ''),
            'MontMet'      => $_POST['MontMet']           ?? '',
            'MontMetClo'   => $_POST['MontMetClo']        ?? '',
            'MontAff'      => $_POST['MontAff']           ?? '',
            'NomPresident' => trim($_POST['NomPresident'] ?? ''),
        ];
    }

    private function emptyData(): array
    {
        return [
            'CodeCat' => '', 'LibCat' => '', 'Decre' => '',
            'MontMet' => '', 'MontMetClo' => '', 'MontAff' => '',
            'NomPresident' => '',
        ];
    }

    private function validate(array $data, bool $checkCode): array
    {
        $errors = [];
        if ($checkCode && $data['CodeCat'] === '') {
            $errors[] = 'رمز الفئة مطلوب';
        }
        if ($data['LibCat'] === '') {
            $errors[] = 'اسم الفئة مطلوب';
        }
        return $errors;
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
