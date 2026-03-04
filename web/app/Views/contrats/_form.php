<?php
/**
 * Formulaire partagé contrat (create + edit)
 * Variables disponibles: $contrat (array), $activites (array), $adresses (array), $errors (array)
 */
$c = $contrat ?? [];
$e = fn(string $k) => htmlspecialchars((string)($c[$k] ?? ''), ENT_QUOTES, 'UTF-8');
$checked = fn(string $k) => !empty($c[$k]) ? 'checked' : '';
?>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
    <?php foreach ($errors as $err): ?>
        <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="post">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

<!-- Section 1: Données personnelles -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white fw-semibold">
        <i class="fas fa-user me-2"></i>البيانات الشخصية
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">رقم العقد <span class="text-danger">*</span></label>
                <input type="text" name="Numero" class="form-control" value="<?= $e('Numero') ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">الاسم <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control" value="<?= $e('nom') ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">رقم البطاقة الوطنية</label>
                <input type="text" name="CIN" class="form-control" maxlength="10" value="<?= $e('CIN') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">الهاتف</label>
                <input type="text" name="Telephone" class="form-control" maxlength="10" value="<?= $e('Telephone') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">الرقم الجبائي</label>
                <input type="text" name="MatriculeFis" class="form-control" value="<?= $e('MatriculeFis') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">الاسم التجاري</label>
                <input type="text" name="NomCom" class="form-control" maxlength="15" value="<?= $e('NomCom') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">النشاط</label>
                <select name="CodeAct" class="form-select">
                    <option value="">-- اختر النشاط --</option>
                    <?php foreach ($activites as $act): ?>
                    <option value="<?= (int)$act['CodeAct'] ?>"
                        <?= ((string)($c['CodeAct'] ?? '')) === (string)$act['CodeAct'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($act['LibAct'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">العنوان</label>
                <select name="CodeAdr" class="form-select">
                    <option value="">-- اختر العنوان --</option>
                    <?php foreach ($adresses as $adr): ?>
                    <option value="<?= (int)$adr['CodeAdr'] ?>"
                        <?= ((string)($c['CodeAdr'] ?? '')) === (string)$adr['CodeAdr'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($adr['LibAdr'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Section 2: Données du contrat -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-success text-white fw-semibold">
        <i class="fas fa-file-signature me-2"></i>بيانات العقد
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">تاريخ البداية</label>
                <input type="date" name="DateD" class="form-control" value="<?= $e('DateD') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">تاريخ التوقيع</label>
                <input type="date" name="DateSignature" class="form-control" value="<?= $e('DateSignature') ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="Signature" id="chkSignature" <?= $checked('Signature') ?>>
                    <label class="form-check-label fw-semibold" for="chkSignature">موقّع</label>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">تاريخ الإرجاع</label>
                <input type="date" name="DateRetour" class="form-control" value="<?= $e('DateRetour') ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="Retour" id="chkRetour" <?= $checked('Retour') ?>>
                    <label class="form-check-label fw-semibold" for="chkRetour">مُرجَع</label>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">رئيس المجلس</label>
                <input type="text" name="NomPresident" class="form-control" maxlength="100" value="<?= $e('NomPresident') ?>">
            </div>
        </div>
    </div>
</div>

<!-- Section 3: Enregistrement -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-info text-white fw-semibold">
        <i class="fas fa-registered me-2"></i>التسجيل
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">تاريخ التسجيل</label>
                <input type="date" name="DateEnr" class="form-control" value="<?= $e('DateEnr') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">رقم التسجيل</label>
                <input type="text" name="NumeroEnr" class="form-control" value="<?= $e('NumeroEnr') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">مبلغ التسجيل</label>
                <input type="number" name="MontantEnr" class="form-control" step="0.001" value="<?= $e('MontantEnr') ?>">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="ValidEnr" id="chkValidEnr" <?= $checked('ValidEnr') ?>>
                    <label class="form-check-label fw-semibold" for="chkValidEnr">صالح التسجيل</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 4: Exécution -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-warning text-dark fw-semibold">
        <i class="fas fa-tasks me-2"></i>التنفيذ والمبالغ
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold">سنة التنفيذ</label>
                <input type="number" name="AnneeExc" class="form-control" min="1900" max="2100" value="<?= $e('AnneeExc') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">مبلغ التنفيذ</label>
                <input type="number" name="MontantExc" class="form-control" step="0.001" value="<?= $e('MontantExc') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">الكمية</label>
                <input type="number" name="Quantite" class="form-control" step="0.001" value="<?= $e('Quantite') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">المبلغ السنوي</label>
                <input type="number" name="MontantAnn" class="form-control" step="0.001" value="<?= $e('MontantAnn') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">عدد الأيام</label>
                <input type="number" name="NbrJour" class="form-control" value="<?= $e('NbrJour') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">المبلغ الحرفي</label>
                <input type="number" name="MontantLit" class="form-control" step="0.001" value="<?= $e('MontantLit') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">رقم الأمر</label>
                <input type="text" name="NumOrd" class="form-control" value="<?= $e('NumOrd') ?>">
            </div>
            <div class="col-md-9">
                <label class="form-label fw-semibold">ملاحظات</label>
                <textarea name="observation" class="form-control" rows="2" maxlength="255"><?= $e('observation') ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary px-5">
        <i class="fas fa-save me-2"></i>حفظ
    </button>
    <a href="index.php?page=contrats" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-right me-2"></i>إلغاء
    </a>
</div>
</form>
