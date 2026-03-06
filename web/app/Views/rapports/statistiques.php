<?php
/**
 * Vue statistiques HTML
 * Variables: $annee (string), $statsArrond (array), $availableYears (array), $loadCharts (bool)
 */
$e = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
$fmtAmount = fn(?float $v) => number_format((float)($v ?? 0), 3, '.', ' ') . ' TND';
?>
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-chart-bar me-2 text-warning"></i>إحصائيات العقود</h4>
    <button onclick="window.print()" class="btn btn-outline-secondary">
        <i class="fas fa-print me-1"></i>طباعة
    </button>
</div>

<!-- Year filter -->
<div class="card border-0 shadow-sm mb-4 d-print-none">
    <div class="card-body">
        <form method="get" action="index.php" class="row g-3 align-items-end">
            <input type="hidden" name="page" value="rapports">
            <input type="hidden" name="action" value="stats">
            <div class="col-md-4">
                <label class="form-label fw-semibold">تصفية حسب السنة</label>
                <select name="annee" class="form-select">
                    <option value="">كل السنوات</option>
                    <?php foreach ($availableYears as $yr): ?>
                        <option value="<?= $e($yr) ?>" <?= (string)$annee === (string)$yr ? 'selected' : '' ?>>
                            <?= $e($yr) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i>تطبيق
                </button>
            </div>
            <?php if ($annee !== ''): ?>
            <div class="col-md-2">
                <a href="index.php?page=rapports&action=stats" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-redo me-1"></i>إعادة تعيين
                </a>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php if (!empty($annee)): ?>
<div class="alert <?= !empty($statsArrond) ? 'alert-info' : 'alert-warning' ?> d-print-none">
    <i class="fas <?= !empty($statsArrond) ? 'fa-info-circle' : 'fa-exclamation-triangle' ?> me-2"></i>
    <?php if (!empty($statsArrond)): ?>
        يتم عرض بيانات سنة: <strong><?= $e($annee) ?></strong>
    <?php else: ?>
        لا توجد بيانات لسنة: <strong><?= $e($annee) ?></strong>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- Summary table per arrondissement -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-transparent fw-semibold border-bottom">
        <i class="fas fa-table me-2 text-primary"></i>ملخص حسب الدائرة
        <?php if ($annee !== ''): ?>
            <span class="badge bg-info me-2"><?= $e($annee) ?></span>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>الدائرة</th>
                        <th class="text-end">عدد العقود</th>
                        <th class="text-end">إجمالي مبالغ التسجيل</th>
                        <th class="text-end">إجمالي مبالغ التنفيذ</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($statsArrond)): ?>
                    <?php
                    $grandTotal   = 0;
                    $grandEnr     = 0.0;
                    $grandExc     = 0.0;
                    foreach ($statsArrond as $row):
                        $grandTotal += (int)$row['total'];
                        $grandEnr   += (float)$row['sumMontantEnr'];
                        $grandExc   += (float)$row['sumMontantExc'];
                    ?>
                    <tr>
                        <td class="fw-semibold"><?= $e($row['LibArr']) ?></td>
                        <td class="text-end"><?= (int)$row['total'] ?></td>
                        <td class="text-end text-nowrap"><?= $fmtAmount((float)$row['sumMontantEnr']) ?></td>
                        <td class="text-end text-nowrap"><?= $fmtAmount((float)$row['sumMontantExc']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="table-primary fw-bold">
                        <td>المجموع</td>
                        <td class="text-end"><?= $grandTotal ?></td>
                        <td class="text-end text-nowrap"><?= $fmtAmount($grandEnr) ?></td>
                        <td class="text-end text-nowrap"><?= $fmtAmount($grandExc) ?></td>
                    </tr>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center text-muted py-4">لا توجد بيانات</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bar chart: MontantEnr per arrondissement -->
<?php if (!empty($statsArrond)): ?>
<div class="card border-0 shadow-sm mb-4 d-print-none">
    <div class="card-header bg-transparent fw-semibold border-bottom">
        <i class="fas fa-chart-bar me-2 text-warning"></i>مبالغ التسجيل حسب الدائرة
    </div>
    <div class="card-body">
        <canvas id="chartArrondMontant" height="120"></canvas>
    </div>
</div>

<script>
(function () {
    'use strict';
    const labels = <?= json_encode(array_column($statsArrond, 'LibArr')) ?>;
    const data   = <?= json_encode(array_map(fn($r) => round((float)$r['sumMontantEnr'], 3), $statsArrond)) ?>;
    new Chart(document.getElementById('chartArrondMontant'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'مبلغ التسجيل (TND)',
                data: data,
                backgroundColor: '#ffc107',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
}());
</script>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
