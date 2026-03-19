<?php
$e   = fn(mixed $v) => htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
$fmt = fn(?string $d) => $d ? date('d/m/Y', strtotime($d)) : '—';
require __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
        <i class="fas fa-file-contract me-2 text-primary"></i>عقد رقم: <?= $e($contrat['Numero']) ?>
    </h4>
    <div class="d-flex gap-2">
        <a href="index.php?page=contrats&action=edit&id=<?= (int)$contrat['id'] ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit me-1"></i>تعديل
        </a>
        <a href="index.php?page=contrats&action=imprimer&id=<?= (int)$contrat['id'] ?>" class="btn btn-secondary btn-sm" target="_blank">
            <i class="fas fa-print me-1"></i>طباعة PDF
        </a>
        <a href="index.php?page=contrats" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i>العودة
        </a>
    </div>
</div>

<?php if (!empty($_GET['msg'])): ?>
    <?php $msgs = ['created'=>'تم إنشاء العقد بنجاح','updated'=>'تم تحديث العقد بنجاح']; ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i><?= $e($msgs[$_GET['msg']] ?? '') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-primary text-white fw-semibold"><i class="fas fa-user me-2"></i>البيانات الشخصية</div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted fw-semibold w-40">رقم العقد</td><td><?= $e($contrat['Numero']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">الاسم</td><td><?= $e($contrat['nom']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">ب.و.ت</td><td><?= $e($contrat['CIN']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">الهاتف</td><td><?= $e($contrat['Telephone']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">الرقم الجبائي</td><td><?= $e($contrat['MatriculeFis']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">الاسم التجاري</td><td><?= $e($contrat['NomCom']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">النشاط</td><td><?= $e($contrat['LibAct']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">العنوان</td><td><?= $e($contrat['LibAdr']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-success text-white fw-semibold"><i class="fas fa-file-signature me-2"></i>بيانات العقد</div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted fw-semibold w-40">تاريخ البداية</td><td><?= $fmt($contrat['DateD']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">تاريخ التوقيع</td><td><?= $fmt($contrat['DateSignature']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">موقّع</td>
                        <td><?= $contrat['Signature'] ? '<span class="badge bg-success">نعم</span>' : '<span class="badge bg-secondary">لا</span>' ?></td></tr>
                    <tr><td class="text-muted fw-semibold">تاريخ الإرجاع</td><td><?= $fmt($contrat['DateRetour']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">مُرجَع</td>
                        <td><?= $contrat['Retour'] ? '<span class="badge bg-info">نعم</span>' : '<span class="badge bg-secondary">لا</span>' ?></td></tr>
                    <tr><td class="text-muted fw-semibold">رئيس المجلس</td><td><?= $e($contrat['NomPresident']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white fw-semibold"><i class="fas fa-registered me-2"></i>التسجيل</div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted fw-semibold w-40">تاريخ التسجيل</td><td><?= $fmt($contrat['DateEnr']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">رقم التسجيل</td><td><?= $e($contrat['NumeroEnr']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">مبلغ التسجيل</td><td><?= $e($contrat['MontantEnr']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">صالح التسجيل</td>
                        <td><?= $contrat['ValidEnr'] ? '<span class="badge bg-success">نعم</span>' : '<span class="badge bg-secondary">لا</span>' ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark fw-semibold"><i class="fas fa-tasks me-2"></i>التنفيذ والمبالغ</div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted fw-semibold w-40">سنة التنفيذ</td><td><?= $e($contrat['AnneeExc']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">مبلغ التنفيذ</td><td><?= $e($contrat['MontantExc']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">الكمية</td><td><?= $e($contrat['Quantite']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">المبلغ السنوي</td><td><?= $e($contrat['MontantAnn']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">عدد الأيام</td><td><?= $e($contrat['NbrJour']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">المبلغ الحرفي</td><td><?= $e($contrat['MontantLit']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">رقم الأمر</td><td><?= $e($contrat['NumOrd']) ?></td></tr>
                    <tr><td class="text-muted fw-semibold">ملاحظات</td><td><?= $e($contrat['observation']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
