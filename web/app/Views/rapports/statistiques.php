<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إحصائيات العقود</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>@media print { .no-print { display: none; } }</style>
</head>
<body class="p-4">
<div class="no-print mb-3">
    <button onclick="window.print()" class="btn btn-primary">طباعة</button>
    <a href="index.php?page=dashboard" class="btn btn-secondary me-2">رجوع</a>
</div>
<h3 class="text-center mb-4 fw-bold">إحصائيات العقود</h3>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center border-primary">
            <div class="card-body">
                <div class="fs-2 fw-bold text-primary"><?= (int)$total ?></div>
                <div>إجمالي العقود</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-success">
            <div class="card-body">
                <div class="fs-2 fw-bold text-success"><?= (int)($signed['signed'] ?? 0) ?></div>
                <div>موقّعة</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-warning">
            <div class="card-body">
                <div class="fs-2 fw-bold text-warning"><?= (int)($signed['unsigned'] ?? 0) ?></div>
                <div>غير موقّعة</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-info">
            <div class="card-body">
                <div class="fs-2 fw-bold text-info"><?= (int)$thisMonth ?></div>
                <div>هذا الشهر</div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
