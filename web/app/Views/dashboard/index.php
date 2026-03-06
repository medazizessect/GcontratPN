<?php
/**
 * Dashboard — KPI + Charts + Recent contracts + Alerts
 * Variables available: $stats (array), $recentContrats (array)
 *
 * Fallback: if this view is loaded via the old route (no DashboardController),
 * compute stats on the fly using $contratModel.
 */
if (!isset($stats)) {
    /** @var \App\Models\Contrat $contratModel */
    $stats          = $contratModel->getStats();
    $recentContrats = $contratModel->getRecent(5);
}

$parActiviteLabels = json_encode(array_column($stats['par_activite'], 'LibAct'), JSON_UNESCAPED_UNICODE);
$parActiviteData   = json_encode(array_column($stats['par_activite'], 'nb'));

$parMoisLabels = json_encode(array_column($stats['par_mois'], 'mois'));
$parMoisData   = json_encode(array_column($stats['par_mois'], 'nb'));

$parStatutLabels = json_encode(array_column($stats['par_statut'], 'statut'), JSON_UNESCAPED_UNICODE);
$parStatutData   = json_encode(array_column($stats['par_statut'], 'nb'));
?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<!-- ═══ KPI Cards ════════════════════════════════════════════════════════════ -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                    <i class="fas fa-file-contract fa-2x text-primary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-primary"><?= number_format((int)$stats['total']) ?></div>
                    <div class="text-muted small">إجمالي العقود</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-success"><?= number_format((int)$stats['signes']) ?></div>
                    <div class="text-muted small">عقود موقّعة</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                    <i class="fas fa-coins fa-2x text-warning"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-warning"><?= number_format($stats['montant_total'], 3) ?></div>
                    <div class="text-muted small">المبلغ الإجمالي المسجّل</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                    <i class="fas fa-clock fa-2x text-danger"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-danger"><?= number_format((int)$stats['en_cours']) ?></div>
                    <div class="text-muted small">عقود جارية (موقّعة غير مُرجعة)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══ Alerts ═══════════════════════════════════════════════════════════════ -->
<?php if (!empty($stats['alertes'])): ?>
<div class="alert alert-warning d-flex align-items-start gap-2 mb-4" role="alert">
    <i class="fas fa-exclamation-triangle fs-5 mt-1"></i>
    <div>
        <strong>تنبيه:</strong> <?= count($stats['alertes']) ?> عقد/عقود غير موقّعة منذ أكثر من 30 يوماً:
        <ul class="mb-0 mt-1">
            <?php foreach ($stats['alertes'] as $al): ?>
            <li>
                <a href="index.php?page=contrats&action=show&id=<?= (int)$al['id'] ?>">
                    <?= htmlspecialchars($al['Numero'], ENT_QUOTES, 'UTF-8') ?>
                </a>
                — <?= htmlspecialchars($al['nom'], ENT_QUOTES, 'UTF-8') ?>
                (<?= htmlspecialchars($al['DateD'] ?? '', ENT_QUOTES, 'UTF-8') ?>)
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<!-- ═══ Charts ═══════════════════════════════════════════════════════════════ -->
<div class="row g-4 mb-4">
    <!-- Bar: contrats par activité -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 fw-semibold">
                <i class="fas fa-chart-bar me-2 text-primary"></i>العقود حسب النشاط (أعلى 10)
            </div>
            <div class="card-body">
                <canvas id="chartActivite" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- Donut: répartition par statut -->
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 fw-semibold">
                <i class="fas fa-chart-pie me-2 text-success"></i>توزيع حسب الحالة
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="chartStatut" height="220"></canvas>
            </div>
        </div>
    </div>
    <!-- Line: évolution mensuelle -->
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 fw-semibold">
                <i class="fas fa-chart-line me-2 text-info"></i>تطور العقود الشهري
            </div>
            <div class="card-body">
                <canvas id="chartMois" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ═══ Recent contracts table ═══════════════════════════════════════════════ -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="fas fa-list me-2 text-primary"></i>آخر العقود المضافة</span>
        <a href="index.php?page=contrats" class="btn btn-sm btn-outline-primary">عرض الكل</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>الرقم</th>
                        <th>الاسم</th>
                        <th>النشاط</th>
                        <th>الفئة</th>
                        <th>تاريخ البداية</th>
                        <th>موقّع</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recentContrats)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">لا توجد بيانات</td></tr>
                    <?php else: ?>
                    <?php foreach ($recentContrats as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['Numero'],  ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['nom'],     ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['LibAct'] ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['LibCat'] ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['DateD']   ?? '—', ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <?php if ($c['Signature']): ?>
                                <span class="badge bg-success">✓</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">✗</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?page=contrats&action=show&id=<?= (int)$c['id'] ?>"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ═══ Quick-access cards ════════════════════════════════════════════════════ -->
<div class="row g-3">
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats&action=create"
           class="card text-center text-decoration-none border-0 shadow-sm h-100">
            <div class="card-body py-4">
                <i class="fas fa-plus-circle fa-2x text-primary mb-2"></i>
                <div class="fw-semibold small">عقد جديد</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats"
           class="card text-center text-decoration-none border-0 shadow-sm h-100">
            <div class="card-body py-4">
                <i class="fas fa-list fa-2x text-success mb-2"></i>
                <div class="fw-semibold small">قائمة العقود</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=liste"
           class="card text-center text-decoration-none border-0 shadow-sm h-100">
            <div class="card-body py-4">
                <i class="fas fa-print fa-2x text-info mb-2"></i>
                <div class="fw-semibold small">طباعة القائمة</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=stats"
           class="card text-center text-decoration-none border-0 shadow-sm h-100">
            <div class="card-body py-4">
                <i class="fas fa-chart-bar fa-2x text-warning mb-2"></i>
                <div class="fw-semibold small">الإحصائيات</div>
            </div>
        </a>
    </div>
</div>

<!-- ═══ Chart.js initialisation ══════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';

    // ── Bar: par activité ──────────────────────────────────────────────────
    const ctxAct = document.getElementById('chartActivite');
    if (ctxAct) {
        new Chart(ctxAct, {
            type: 'bar',
            data: {
                labels: <?= $parActiviteLabels ?>,
                datasets: [{
                    label: 'عدد العقود',
                    data: <?= $parActiviteData ?>,
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    }

    // ── Donut: par statut ──────────────────────────────────────────────────
    const ctxStat = document.getElementById('chartStatut');
    if (ctxStat) {
        new Chart(ctxStat, {
            type: 'doughnut',
            data: {
                labels: <?= $parStatutLabels ?>,
                datasets: [{
                    data: <?= $parStatutData ?>,
                    backgroundColor: ['#198754', '#dc3545', '#0dcaf0'],
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    // ── Line: par mois ─────────────────────────────────────────────────────
    const ctxMois = document.getElementById('chartMois');
    if (ctxMois) {
        new Chart(ctxMois, {
            type: 'line',
            data: {
                labels: <?= $parMoisLabels ?>,
                datasets: [{
                    label: 'عقود',
                    data: <?= $parMoisData ?>,
                    fill: true,
                    backgroundColor: 'rgba(13, 202, 240, 0.15)',
                    borderColor: 'rgba(13, 202, 240, 1)',
                    tension: 0.4,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    }
})();
</script>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary text-white"><i class="fas fa-file-contract fa-2x"></i></div>
                <div>
                    <div class="fs-1 fw-bold text-primary"><?= (int)$totalContrats ?></div>
                    <div class="text-muted">إجمالي العقود</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success text-white"><i class="fas fa-check-circle fa-2x"></i></div>
                <div>
                    <div class="fs-1 fw-bold text-success"><?= (int)($signed['signes'] ?? 0) ?></div>
                    <div class="text-muted">عقود موقّعة</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning text-white"><i class="fas fa-clock fa-2x"></i></div>
                <div>
                    <div class="fs-1 fw-bold text-warning"><?= (int)($signed['non_signes'] ?? 0) ?></div>
                    <div class="text-muted">غير موقّعة</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-info text-white"><i class="fas fa-calendar fa-2x"></i></div>
                <div>
                    <div class="fs-1 fw-bold text-info"><?= (int)$thisMonth ?></div>
                    <div class="text-muted">عقود هذا الشهر</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <h5 class="fw-bold mb-3"><i class="fas fa-bolt me-2 text-primary"></i>وصول سريع</h5>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats&action=create" class="card text-center text-decoration-none border-0 shadow-sm quick-card">
            <div class="card-body py-4">
                <i class="fas fa-plus-circle fa-3x text-primary mb-2"></i>
                <div class="fw-semibold">عقد جديد</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats" class="card text-center text-decoration-none border-0 shadow-sm quick-card">
            <div class="card-body py-4">
                <i class="fas fa-list fa-3x text-success mb-2"></i>
                <div class="fw-semibold">قائمة العقود</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=liste" class="card text-center text-decoration-none border-0 shadow-sm quick-card">
            <div class="card-body py-4">
                <i class="fas fa-print fa-3x text-info mb-2"></i>
                <div class="fw-semibold">طباعة القائمة</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=stats" class="card text-center text-decoration-none border-0 shadow-sm quick-card">
            <div class="card-body py-4">
                <i class="fas fa-chart-bar fa-3x text-warning mb-2"></i>
                <div class="fw-semibold">الإحصائيات</div>
            </div>
        </a>
    </div>
</div>

