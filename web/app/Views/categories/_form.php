<div class="mb-3">
    <h4 class="fw-bold"><?= $categorie['id'] ? 'تعديل الفئة' : 'إضافة فئة' ?></h4>
    <a href="index.php?page=categories" class="btn btn-secondary btn-sm">رجوع</a>
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
                <input type="text" name="libelle" class="form-control" value="<?= htmlspecialchars($categorie['libelle'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">المبلغ</label>
                <input type="number" step="0.01" name="montant" class="form-control" value="<?= htmlspecialchars($categorie['montant'] ?? '0', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="index.php?page=categories" class="btn btn-secondary me-2">إلغاء</a>
        </form>
    </div>
</div>
