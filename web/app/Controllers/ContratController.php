<?php

namespace App\Controllers;

use App\Models\Contrat;
use App\Models\Activite;
use App\Models\Adresse;

class ContratController
{
    private Contrat $model;
    private Activite $activiteModel;
    private Adresse $adresseModel;

    public function __construct()
    {
        $this->model         = new Contrat();
        $this->activiteModel = new Activite();
        $this->adresseModel  = new Adresse();
    }

    public function index(): void
    {
        $filters = [
            'Numero'     => trim($_GET['Numero'] ?? ''),
            'nom'        => trim($_GET['nom'] ?? ''),
            'CIN'        => trim($_GET['CIN'] ?? ''),
            'Signature'  => $_GET['Signature'] ?? '',
            'DateD_from' => $_GET['DateD_from'] ?? '',
            'DateD_to'   => $_GET['DateD_to'] ?? '',
            'AnneeExc'   => $_GET['AnneeExc'] ?? '',
        ];

        $page    = max(1, (int) ($_GET['p'] ?? 1));
        $perPage = 20;
        $offset  = ($page - 1) * $perPage;

        $result   = $this->model->search($filters, $perPage, $offset);
        $contrats = $result['data'];
        $total    = $result['total'];
        $pages    = (int) ceil($total / $perPage);

        require __DIR__ . '/../Views/contrats/index.php';
    }

    public function create(): void
    {
        $activites = $this->activiteModel->getAll();
        $adresses  = $this->adresseModel->getAll();
        $errors    = [];
        $data      = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data   = $this->getPostData();
            $errors = $this->validate($data);

            if (empty($errors)) {
                $id = $this->model->create($data);
                header('Location: index.php?page=contrats&action=show&id=' . $id . '&msg=created');
                exit;
            }
        }

        require __DIR__ . '/../Views/contrats/create.php';
    }

    public function edit(int $id): void
    {
        $contrat = $this->model->getById($id);
        if (!$contrat) {
            http_response_code(404);
            exit('الملف غير موجود');
        }

        $activites = $this->activiteModel->getAll();
        $adresses  = $this->adresseModel->getAll();
        $errors    = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data    = $this->getPostData();
            $errors  = $this->validate($data);

            if (empty($errors)) {
                $this->model->update($id, $data);
                header('Location: index.php?page=contrats&action=show&id=' . $id . '&msg=updated');
                exit;
            }
            $contrat = array_merge($contrat, $data);
        }

        require __DIR__ . '/../Views/contrats/edit.php';
    }

    public function show(int $id): void
    {
        $contrat = $this->model->getById($id);
        if (!$contrat) {
            http_response_code(404);
            exit('الملف غير موجود');
        }
        require __DIR__ . '/../Views/contrats/show.php';
    }

    public function delete(int $id): void
    {
        $this->verifyCsrf();
        $this->model->delete($id);
        header('Location: index.php?page=contrats&msg=deleted');
        exit;
    }

    public function imprimer(int $id): void
    {
        $controller = new RapportController();
        $controller->imprimerContrat($id);
    }

    private function getPostData(): array
    {
        return [
            'Numero'       => trim($_POST['Numero'] ?? ''),
            'nom'          => trim($_POST['nom'] ?? ''),
            'CIN'          => trim($_POST['CIN'] ?? ''),
            'Telephone'    => trim($_POST['Telephone'] ?? ''),
            'MatriculeFis' => trim($_POST['MatriculeFis'] ?? ''),
            'NomCom'       => trim($_POST['NomCom'] ?? ''),
            'CodeAct'      => $_POST['CodeAct'] ?? null,
            'CodeAdr'      => $_POST['CodeAdr'] ?? null,
            'DateD'        => $_POST['DateD'] ?? '',
            'DateSignature'=> $_POST['DateSignature'] ?? '',
            'Signature'    => isset($_POST['Signature']) ? 1 : 0,
            'DateRetour'   => $_POST['DateRetour'] ?? '',
            'Retour'       => isset($_POST['Retour']) ? 1 : 0,
            'DateEnr'      => $_POST['DateEnr'] ?? '',
            'NumeroEnr'    => trim($_POST['NumeroEnr'] ?? ''),
            'MontantEnr'   => $_POST['MontantEnr'] ?? '',
            'ValidEnr'     => isset($_POST['ValidEnr']) ? 1 : 0,
            'AnneeExc'     => $_POST['AnneeExc'] ?? '',
            'MontantExc'   => $_POST['MontantExc'] ?? '',
            'Quantite'     => $_POST['Quantite'] ?? '',
            'MontantAnn'   => $_POST['MontantAnn'] ?? '',
            'NbrJour'      => $_POST['NbrJour'] ?? '',
            'MontantLit'   => $_POST['MontantLit'] ?? '',
            'NumOrd'       => trim($_POST['NumOrd'] ?? ''),
            'NomPresident' => trim($_POST['NomPresident'] ?? ''),
            'observation'  => trim($_POST['observation'] ?? ''),
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];
        if ($data['Numero'] === '') {
            $errors[] = 'رقم العقد مطلوب';
        }
        if ($data['nom'] === '') {
            $errors[] = 'الاسم مطلوب';
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
