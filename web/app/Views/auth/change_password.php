<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-key me-2"></i>تغيير كلمة المرور</h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <form method="post" action="index.php?page=auth&action=change_password">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" name="new_password" class="form-control" minlength="6" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="confirm_password" class="form-control" minlength="6" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
