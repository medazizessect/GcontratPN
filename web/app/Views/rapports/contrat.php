<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عقد رقم <?= htmlspecialchars($contrat['num_contrat'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>@media print { .no-print { display: none; } }</style>
</head>
<body class="p-4">
<div class="no-print mb-3">
    <button onclick="window.print()" class="btn btn-primary">طباعة</button>
    <a href="javascript:history.back()" class="btn btn-secondary me-2">رجوع</a>
</div>
<div class="card p-4">
    <h3 class="text-center mb-4 fw-bold">بطاقة العقد</h3>
    <div class="row g-3">
        <div class="col-6"><strong>رقم العقد:</strong> <?= htmlspecialchars($contrat['num_contrat'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>تاريخ العقد:</strong> <?= htmlspecialchars($contrat['date_contrat'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>الاسم:</strong> <?= htmlspecialchars($contrat['nom'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>اللقب:</strong> <?= htmlspecialchars($contrat['prenom'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>CIN:</strong> <?= htmlspecialchars($contrat['cin'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>الهاتف:</strong> <?= htmlspecialchars($contrat['telephone'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>العنوان:</strong> <?= htmlspecialchars($contrat['adresse_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>الدائرة:</strong> <?= htmlspecialchars($contrat['arrondissement_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>النشاط:</strong> <?= htmlspecialchars($contrat['activite_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>الفئة:</strong> <?= htmlspecialchars($contrat['categorie_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>تاريخ البداية:</strong> <?= htmlspecialchars($contrat['date_debut'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>تاريخ النهاية:</strong> <?= htmlspecialchars($contrat['date_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="col-6"><strong>المبلغ:</strong> <?= number_format((float)$contrat['montant'], 2) ?></div>
        <div class="col-6"><strong>المبلغ المدفوع:</strong> <?= number_format((float)$contrat['montant_paye'], 2) ?></div>
        <div class="col-6"><strong>الحالة:</strong> <?= $contrat['statut'] === 'signed' ? 'موقّع' : 'غير موقّع' ?></div>
        <div class="col-12"><strong>ملاحظة:</strong> <?= htmlspecialchars($contrat['observation'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
