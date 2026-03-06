<?php

namespace App\Controllers;

use App\Models\Contrat;

class DashboardController
{
    public function index(): void
    {
        $contratModel = new Contrat();
        $stats        = $contratModel->getStats();
        $recentContrats = $contratModel->getRecent(5);

        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/dashboard/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }
}
