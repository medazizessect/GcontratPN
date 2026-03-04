<?php
$totalContrats = $contratModel->countAll();
$signed        = $contratModel->countBySigned();
$thisMonth     = $contratModel->countThisMonth();
?>
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="fs-1 fw-bold text-primary"><?= (int)$totalContrats ?></div>
                <div class="text-muted">إجمالي العقود</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="fs-1 fw-bold text-success"><?= (int)($signed['signed'] ?? 0) ?></div>
                <div class="text-muted">عقود موقّعة</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="fs-1 fw-bold text-warning"><?= (int)($signed['unsigned'] ?? 0) ?></div>
                <div class="text-muted">غير موقّعة</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="fs-1 fw-bold text-info"><?= (int)$thisMonth ?></div>
                <div class="text-muted">عقود هذا الشهر</div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-12"><h5 class="fw-bold">وصول سريع</h5></div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats&action=create" class="btn btn-primary w-100 py-3">عقد جديد</a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=contrats" class="btn btn-outline-primary w-100 py-3">قائمة العقود</a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=liste" class="btn btn-outline-info w-100 py-3">طباعة القائمة</a>
    </div>
    <div class="col-6 col-md-3">
        <a href="index.php?page=rapports&action=statistiques" class="btn btn-outline-warning w-100 py-3">الإحصائيات</a>
    </div>
</div>
