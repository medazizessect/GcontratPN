<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">العقود</h4>
    <a href="index.php?page=contrats&action=create" class="btn btn-primary">+ عقد جديد</a>
</div>
<form method="get" action="index.php" class="mb-3 d-flex gap-2">
    <input type="hidden" name="page" value="contrats">
    <input type="text" name="search" class="form-control" placeholder="بحث..." value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
    <button type="submit" class="btn btn-secondary">بحث</button>
</form>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>رقم العقد</th>
                <th>الاسم</th>
                <th>اللقب</th>
                <th>CIN</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contrats as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['num_contrat'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['prenom'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($c['cin'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= $c['statut'] === 'signed' ? '<span class="badge bg-success">موقّع</span>' : '<span class="badge bg-warning text-dark">غير موقّع</span>' ?></td>
                <td class="d-flex gap-1">
                    <a href="index.php?page=contrats&action=show&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-info">عرض</a>
                    <a href="index.php?page=contrats&action=edit&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="index.php?page=contrats&action=imprimer&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-secondary" target="_blank">طباعة</a>
                    <a href="index.php?page=contrats&action=delete&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($contrats)): ?>
            <tr><td colspan="6" class="text-center text-muted">لا توجد نتائج</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if ($pages > 1): ?>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
            <a class="page-link" href="index.php?page=contrats&p=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
