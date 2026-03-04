<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white fw-bold">تغيير كلمة المرور</div>
            <div class="card-body p-4">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <form method="post" action="index.php?page=auth&action=change_password">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="text" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="text" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                        <input type="text" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="index.php?page=dashboard" class="btn btn-secondary me-2">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
