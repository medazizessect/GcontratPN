<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قائمة العقود</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>@media print { .no-print { display: none; } }</style>
</head>
<body class="p-4">
<div class="no-print mb-3">
    <button onclick="window.print()" class="btn btn-primary">طباعة</button>
    <a href="index.php?page=contrats" class="btn btn-secondary me-2">رجوع</a>
</div>
<h3 class="text-center mb-4 fw-bold">قائمة العقود</h3>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead class="table-dark">
            <tr>
                <th>رقم العقد</th>
                <th>الاسم</th>
                <th>اللقب</th>
                <th>CIN</th>
                <th>النشاط</th>
                <th>المبلغ</th>
                <th>الحالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contrats as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['num_contrat'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['prenom'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['cin'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['activite_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= number_format((float)$c['montant'], 2) ?></td>
                <td><?= $c['statut'] === 'signed' ? 'موقّع' : 'غير موقّع' ?></td>
                <td><?= htmlspecialchars($c['date_contrat'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($contrats)): ?>
            <tr><td colspan="8" class="text-center">لا توجد نتائج</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<p class="text-muted">إجمالي: <?= count($contrats) ?> عقد</p>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
