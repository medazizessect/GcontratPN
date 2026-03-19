<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
        <i class="fas fa-edit me-2 text-warning"></i>تعديل العقد: <?= htmlspecialchars($contrat['Numero'] ?? '', ENT_QUOTES, 'UTF-8') ?>
    </h4>
    <div class="d-flex gap-2">
        <a href="index.php?page=contrats&action=show&id=<?= (int)($contrat['id'] ?? 0) ?>" class="btn btn-outline-info btn-sm">
            <i class="fas fa-eye me-1"></i>عرض
        </a>
        <a href="index.php?page=contrats" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-right me-1"></i>العودة
        </a>
    </div>
</div>

<?php require __DIR__ . '/_form.php'; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
