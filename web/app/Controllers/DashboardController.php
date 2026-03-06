<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Contrat;

class DashboardController
{
    public function index(): void
    {
        $contratModel = new Contrat();
        $stats = [
            'total'          => $contratModel->countTotal(),
            'signed'         => $contratModel->countBySigned(),
            'registered'     => $contratModel->countByRegistered(),
            'returned'       => $contratModel->countByReturned(),
            'sumMontantEnr'  => $contratModel->sumMontantEnr(),
            'byYear'         => $contratModel->countByYear(),
            'byActivite'     => $contratModel->countByActivite(),
            'byMonth'        => $contratModel->countByMonthCurrentYear(),
            'byArrond'       => $contratModel->countByArrondissement(),
            'recentContrats' => $contratModel->getRecent(10),
        ];
        $loadCharts = true;
        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/dashboard/index.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }
}
