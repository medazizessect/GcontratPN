<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold"><i class="fas fa-plus me-2"></i>إضافة فئة جديدة</div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger"><?php foreach ($errors as $err): ?><div><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></div><?php endforeach; ?></div>
                <?php endif; ?>
                <form method="post" action="index.php?page=categories&action=create">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">اسم الفئة</label>
                        <input type="text" name="LibCat" class="form-control" value="<?= htmlspecialchars($data['LibCat'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required autofocus>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>حفظ</button>
                        <a href="index.php?page=categories" class="btn btn-outline-secondary">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
