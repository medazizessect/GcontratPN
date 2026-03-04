<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">العناوين</h4>
    <a href="index.php?page=adresses&action=create" class="btn btn-primary">+ إضافة</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr><th>#</th><th>التسمية</th><th>الإجراءات</th></tr>
        </thead>
        <tbody>
        <?php foreach ($adresses as $a): ?>
            <tr>
                <td><?= (int)$a['id'] ?></td>
                <td><?= htmlspecialchars($a['libelle'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="index.php?page=adresses&action=edit&id=<?= (int)$a['id'] ?>" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="index.php?page=adresses&action=delete&id=<?= (int)$a['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($adresses)): ?>
            <tr><td colspan="3" class="text-center text-muted">لا توجد نتائج</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
