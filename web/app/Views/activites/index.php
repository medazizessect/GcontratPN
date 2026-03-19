<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-briefcase me-2 text-primary"></i>الأنشطة</h4>
    <a href="index.php?page=activites&action=create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i>نشاط جديد
    </a>
</div>

<?php if (!empty($_GET['msg'])): ?>
    <?php $msgs = ['created'=>'تم الإضافة بنجاح','updated'=>'تم التحديث بنجاح','deleted'=>'تم الحذف بنجاح']; ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= htmlspecialchars($msgs[$_GET['msg']] ?? '', ENT_QUOTES, 'UTF-8') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>اسم النشاط</th><th class="text-center">الإجراءات</th></tr>
            </thead>
            <tbody>
            <?php foreach ($activites as $a): ?>
                <tr>
                    <td><?= (int)$a['CodeAct'] ?></td>
                    <td><?= htmlspecialchars($a['LibAct'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="text-center">
                        <a href="index.php?page=activites&action=edit&id=<?= (int)$a['CodeAct'] ?>" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger btn-delete"
                                data-id="<?= (int)$a['CodeAct'] ?>"
                                data-csrf="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($activites)): ?>
                <tr><td colspan="3" class="text-center text-muted py-4">لا توجد أنشطة</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<form id="deleteForm" method="post" action="index.php?page=activites&action=delete">
    <input type="hidden" name="csrf_token" id="deleteToken">
    <input type="hidden" name="id" id="deleteId">
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
