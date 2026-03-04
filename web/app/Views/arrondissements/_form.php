<div class="mb-3">
    <h4 class="fw-bold"><?= $arrondissement['id'] ? 'تعديل الدائرة' : 'إضافة دائرة' ?></h4>
    <a href="index.php?page=arrondissements" class="btn btn-secondary btn-sm">رجوع</a>
</div>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>
<div class="card shadow border-0" style="max-width:500px">
    <div class="card-body p-4">
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <div class="mb-3">
                <label class="form-label">التسمية</label>
                <input type="text" name="libelle" class="form-control" value="<?= htmlspecialchars($arrondissement['libelle'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="index.php?page=arrondissements" class="btn btn-secondary me-2">إلغاء</a>
        </form>
    </div>
</div>
