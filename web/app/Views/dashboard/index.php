<?php
/** @var App\Models\Contrat $contratModel */
$totalContrats  = $contratModel->countAll();
$signed         = $contratModel->countBySigned();
$thisMonth      = $contratModel->countThisMonth();
?>
<?php require __DIR__ . '/../layouts/header.php'; ?>

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

<?php require __DIR__ . '/../layouts/footer.php'; ?>
