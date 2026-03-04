<div class="mb-3 d-flex justify-content-between">
    <h4 class="fw-bold">تفاصيل العقد</h4>
    <div>
        <a href="index.php?page=contrats&action=edit&id=<?= (int)$contrat['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
        <a href="index.php?page=contrats&action=imprimer&id=<?= (int)$contrat['id'] ?>" class="btn btn-secondary btn-sm" target="_blank">طباعة</a>
        <a href="index.php?page=contrats" class="btn btn-outline-secondary btn-sm">رجوع</a>
    </div>
</div>
<div class="card shadow border-0">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-4"><strong>رقم العقد:</strong> <?= htmlspecialchars($contrat['num_contrat'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>الاسم:</strong> <?= htmlspecialchars($contrat['nom'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>اللقب:</strong> <?= htmlspecialchars($contrat['prenom'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>CIN:</strong> <?= htmlspecialchars($contrat['cin'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>الهاتف:</strong> <?= htmlspecialchars($contrat['telephone'], ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>العنوان:</strong> <?= htmlspecialchars($contrat['adresse_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>الدائرة:</strong> <?= htmlspecialchars($contrat['arrondissement_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>النشاط:</strong> <?= htmlspecialchars($contrat['activite_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>الفئة:</strong> <?= htmlspecialchars($contrat['categorie_libelle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>تاريخ العقد:</strong> <?= htmlspecialchars($contrat['date_contrat'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>تاريخ البداية:</strong> <?= htmlspecialchars($contrat['date_debut'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>تاريخ النهاية:</strong> <?= htmlspecialchars($contrat['date_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="col-md-4"><strong>المبلغ:</strong> <?= number_format((float)$contrat['montant'], 2) ?></div>
            <div class="col-md-4"><strong>المبلغ المدفوع:</strong> <?= number_format((float)$contrat['montant_paye'], 2) ?></div>
            <div class="col-md-4"><strong>الحالة:</strong> <?= $contrat['statut'] === 'signed' ? '<span class="badge bg-success">موقّع</span>' : '<span class="badge bg-warning text-dark">غير موقّع</span>' ?></div>
            <div class="col-12"><strong>ملاحظة:</strong> <?= htmlspecialchars($contrat['observation'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        </div>
    </div>
</div>
