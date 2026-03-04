<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-file-contract me-2 text-primary"></i>قائمة العقود</h4>
    <a href="index.php?page=contrats&action=create" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>عقد جديد
    </a>
</div>

<?php if (!empty($_GET['msg'])): ?>
    <?php $msgs = ['created'=>'تم إنشاء العقد بنجاح','updated'=>'تم تحديث العقد بنجاح','deleted'=>'تم حذف العقد بنجاح']; ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($msgs[$_GET['msg']] ?? '', ENT_QUOTES, 'UTF-8') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Formulaire de recherche -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-light fw-semibold">
        <i class="fas fa-search me-2"></i>بحث وتصفية
    </div>
    <div class="card-body">
        <form method="get" action="index.php">
            <input type="hidden" name="page" value="contrats">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="Numero" class="form-control" placeholder="رقم العقد"
                           value="<?= htmlspecialchars($_GET['Numero'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="nom" class="form-control" placeholder="الاسم"
                           value="<?= htmlspecialchars($_GET['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" name="CIN" class="form-control" placeholder="رقم البطاقة"
                           value="<?= htmlspecialchars($_GET['CIN'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-2">
                    <select name="Signature" class="form-select">
                        <option value="">كل الحالات</option>
                        <option value="1" <?= ($_GET['Signature'] ?? '') === '1' ? 'selected' : '' ?>>موقّع</option>
                        <option value="0" <?= ($_GET['Signature'] ?? '') === '0' ? 'selected' : '' ?>>غير موقّع</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill"><i class="fas fa-search me-1"></i>بحث</button>
                    <a href="index.php?page=contrats" class="btn btn-outline-secondary"><i class="fas fa-redo"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tableau -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>رقم العقد</th>
                        <th>الاسم</th>
                        <th>ب.و.ت</th>
                        <th>الهاتف</th>
                        <th>تاريخ البداية</th>
                        <th>النشاط</th>
                        <th class="text-center">موقّع</th>
                        <th class="text-center">مُرجَع</th>
                        <th class="text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($contrats as $c): ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($c['Numero'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['CIN'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($c['Telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= $c['DateD'] ? date('d/m/Y', strtotime($c['DateD'])) : '' ?></td>
                        <td><?= htmlspecialchars($c['LibAct'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center">
                            <?php if ($c['Signature']): ?>
                                <span class="badge bg-success"><i class="fas fa-check"></i></span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><i class="fas fa-times"></i></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($c['Retour']): ?>
                                <span class="badge bg-info"><i class="fas fa-check"></i></span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><i class="fas fa-times"></i></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="index.php?page=contrats&action=show&id=<?= (int)$c['id'] ?>"
                                   class="btn btn-outline-info" title="عرض"><i class="fas fa-eye"></i></a>
                                <a href="index.php?page=contrats&action=edit&id=<?= (int)$c['id'] ?>"
                                   class="btn btn-outline-warning" title="تعديل"><i class="fas fa-edit"></i></a>
                                <a href="index.php?page=contrats&action=imprimer&id=<?= (int)$c['id'] ?>"
                                   class="btn btn-outline-secondary" title="طباعة PDF" target="_blank"><i class="fas fa-print"></i></a>
                                <button type="button" class="btn btn-outline-danger btn-delete" title="حذف"
                                        data-id="<?= (int)$c['id'] ?>"
                                        data-csrf="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($contrats)): ?>
                    <tr><td colspan="9" class="text-center text-muted py-4">لا توجد عقود</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<?php if ($pages > 1): ?>
<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
            <a class="page-link" href="?page=contrats&p=<?= $i ?>&<?= http_build_query(array_filter(['Numero'=>$_GET['Numero']??'','nom'=>$_GET['nom']??'','CIN'=>$_GET['CIN']??'','Signature'=>$_GET['Signature']??''])) ?>">
                <?= $i ?>
            </a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<!-- Modal de confirmation de suppression -->
<form id="deleteForm" method="post" action="index.php?page=contrats&action=delete">
    <input type="hidden" name="csrf_token" id="deleteToken">
    <input type="hidden" name="id" id="deleteId">
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
