<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">الفئات</h4>
    <a href="index.php?page=categories&action=create" class="btn btn-primary">+ إضافة</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr><th>#</th><th>التسمية</th><th>المبلغ</th><th>الإجراءات</th></tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $c): ?>
            <tr>
                <td><?= (int)$c['id'] ?></td>
                <td><?= htmlspecialchars($c['libelle'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= number_format((float)$c['montant'], 2) ?></td>
                <td>
                    <a href="index.php?page=categories&action=edit&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="index.php?page=categories&action=delete&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($categories)): ?>
            <tr><td colspan="4" class="text-center text-muted">لا توجد نتائج</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
