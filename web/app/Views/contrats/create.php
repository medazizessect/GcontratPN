<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>عقد جديد</h4>
    <a href="index.php?page=contrats" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-right me-1"></i>العودة للقائمة
    </a>
</div>

<?php $contrat = $data ?? []; require __DIR__ . '/_form.php'; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
