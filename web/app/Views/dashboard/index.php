<?php
/**
 * Dashboard view
 * Variables: $stats (array with KPIs and chart data)
 */
$e = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
$fmtAmount = fn(?float $v) => number_format((float)($v ?? 0), 3, '.', ' ') . ' TND';
$fmtDate   = fn(?string $d) => $d ? date('d/m/Y', strtotime($d)) : '—';

// Prepare chart data
$yearLabels  = array_column(array_reverse($stats['byYear']), 'annee');
$yearData    = array_column(array_reverse($stats['byYear']), 'total');
$actLabels   = array_column($stats['byActivite'], 'LibAct');
$actData     = array_column($stats['byActivite'], 'total');
$arrLabels   = array_column($stats['byArrond'], 'LibArr');
$arrData     = array_column($stats['byArrond'], 'total');

// Monthly data: fill missing months with 0
$monthTotals = array_fill(1, 12, 0);
foreach ($stats['byMonth'] as $row) {
    $monthTotals[(int)$row['mois']] = (int)$row['total'];
}
$monthNames = ['يناير','فبراير','مارس','أبريل','ماي','جوان','جويلية','أوت','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
?>

<!-- KPI Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-file-contract fa-2x"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-primary"><?= (int)$stats['total'] ?></div>
                    <div class="text-muted small">إجمالي العقود</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success">
                    <i class="fas fa-signature fa-2x"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-success"><?= (int)$stats['signed'] ?></div>
                    <div class="text-muted small">عقود موقّعة</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-info bg-opacity-10 text-info">
                    <i class="fas fa-stamp fa-2x"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-info"><?= (int)$stats['registered'] ?></div>
                    <div class="text-muted small">مسجّلة</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-coins fa-2x"></i>
                </div>
                <div>
                    <div class="fs-5 fw-bold text-warning"><?= $fmtAmount($stats['sumMontantEnr']) ?></div>
                    <div class="text-muted small">مبالغ التسجيل</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-undo-alt fa-2x"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-danger"><?= (int)$stats['returned'] ?></div>
                    <div class="text-muted small">مُرجَعة</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-chart-bar me-2 text-primary"></i>العقود حسب السنة
            </div>
            <div class="card-body">
                <canvas id="chartByYear" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-chart-pie me-2 text-success"></i>العقود حسب النشاط (أعلى 5)
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="chartByActivite" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-chart-line me-2 text-info"></i>العقود الشهرية (السنة الحالية)
            </div>
            <div class="card-body">
                <canvas id="chartByMonth" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-chart-bar me-2 text-warning"></i>أعلى 5 دوائر
            </div>
            <div class="card-body">
                <canvas id="chartByArrond" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Contracts + Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-history me-2 text-primary"></i>آخر 10 عقود
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم العقد</th>
                                <th>الاسم</th>
                                <th>تاريخ البداية</th>
                                <th class="text-center">موقّع</th>
                                <th class="text-end">مبلغ التسجيل</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($stats['recentContrats'] as $c): ?>
                            <tr>
                                <td>
                                    <a href="index.php?page=contrats&action=show&id=<?= (int)$c['id'] ?>"
                                       class="fw-semibold text-decoration-none">
                                        <?= $e($c['Numero']) ?>
                                    </a>
                                </td>
                                <td><?= $e($c['nom']) ?></td>
                                <td><?= $fmtDate($c['DateD']) ?></td>
                                <td class="text-center">
                                    <?php if ($c['Signature']): ?>
                                        <span class="badge bg-success">موقّع</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">غير موقّع</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <?= $c['MontantEnr'] ? $fmtAmount((float)$c['MontantEnr']) : '—' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($stats['recentContrats'])): ?>
                            <tr><td colspan="5" class="text-center text-muted py-4">لا توجد عقود</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent fw-semibold border-bottom">
                <i class="fas fa-bolt me-2 text-warning"></i>وصول سريع
            </div>
            <div class="card-body d-flex flex-column gap-3 justify-content-center">
                <a href="index.php?page=contrats&action=create"
                   class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-plus-circle me-2"></i>عقد جديد
                </a>
                <a href="index.php?page=contrats"
                   class="btn btn-outline-primary btn-lg w-100">
                    <i class="fas fa-list me-2"></i>قائمة العقود
                </a>
                <a href="index.php?page=rapports&action=stats"
                   class="btn btn-outline-warning btn-lg w-100">
                    <i class="fas fa-chart-bar me-2"></i>الإحصائيات
                </a>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    const yearLabels  = <?= json_encode(array_values($yearLabels)) ?>;
    const yearData    = <?= json_encode(array_map('intval', array_values($yearData))) ?>;
    const actLabels   = <?= json_encode(array_values($actLabels)) ?>;
    const actData     = <?= json_encode(array_map('intval', array_values($actData))) ?>;
    const monthLabels = <?= json_encode($monthNames) ?>;
    const monthData   = <?= json_encode(array_values($monthTotals)) ?>;
    const arrLabels   = <?= json_encode(array_values($arrLabels)) ?>;
    const arrData     = <?= json_encode(array_map('intval', array_values($arrData))) ?>;

    const palette = ['#0d6efd','#198754','#0dcaf0','#ffc107','#dc3545','#6f42c1','#fd7e14'];

    // Bar chart — by year
    new Chart(document.getElementById('chartByYear'), {
        type: 'bar',
        data: {
            labels: yearLabels,
            datasets: [{
                label: 'عدد العقود',
                data: yearData,
                backgroundColor: '#0d6efd',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // Doughnut chart — by activite
    new Chart(document.getElementById('chartByActivite'), {
        type: 'doughnut',
        data: {
            labels: actLabels,
            datasets: [{
                data: actData,
                backgroundColor: palette,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Line chart — by month
    new Chart(document.getElementById('chartByMonth'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'عدد العقود',
                data: monthData,
                borderColor: '#0dcaf0',
                backgroundColor: 'rgba(13,202,240,0.1)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // Horizontal bar — by arrondissement
    new Chart(document.getElementById('chartByArrond'), {
        type: 'bar',
        data: {
            labels: arrLabels,
            datasets: [{
                label: 'عدد العقود',
                data: arrData,
                backgroundColor: '#ffc107',
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
}());
</script>
