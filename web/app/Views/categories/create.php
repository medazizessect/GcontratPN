<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="fas fa-plus me-2"></i>إضافة فئة جديدة
            </div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $err): ?>
                    <div><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <form method="post" action="index.php?page=categories&action=create">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">رمز الفئة <span class="text-danger">*</span></label>
                            <input type="text" name="CodeCat" class="form-control text-uppercase"
                                   maxlength="10"
                                   value="<?= htmlspecialchars($data['CodeCat'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   required autofocus placeholder="مثال: CAT01">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">اسم الفئة <span class="text-danger">*</span></label>
                            <input type="text" name="LibCat" class="form-control"
                                   value="<?= htmlspecialchars($data['LibCat'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   required maxlength="50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">المرسوم</label>
                            <input type="text" name="Decre" class="form-control"
                                   value="<?= htmlspecialchars($data['Decre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   maxlength="50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">اسم الرئيس</label>
                            <input type="text" name="NomPresident" class="form-control"
                                   value="<?= htmlspecialchars($data['NomPresident'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   maxlength="100">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">مبلغ المبادرة</label>
                            <input type="number" step="0.001" name="MontMet" class="form-control"
                                   value="<?= htmlspecialchars($data['MontMet'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">مبلغ الإغلاق</label>
                            <input type="number" step="0.001" name="MontMetClo" class="form-control"
                                   value="<?= htmlspecialchars($data['MontMetClo'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">مبلغ الإسناد</label>
                            <input type="number" step="0.001" name="MontAff" class="form-control"
                                   value="<?= htmlspecialchars($data['MontAff'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>حفظ</button>
                        <a href="index.php?page=categories" class="btn btn-outline-secondary">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>

