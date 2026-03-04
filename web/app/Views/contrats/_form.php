<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>
<div class="card shadow border-0">
    <div class="card-body p-4">
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">رقم العقد</label>
                    <input type="text" name="num_contrat" class="form-control" value="<?= htmlspecialchars($contrat['num_contrat'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($contrat['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">اللقب</label>
                    <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($contrat['prenom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">CIN</label>
                    <input type="text" name="cin" class="form-control" value="<?= htmlspecialchars($contrat['cin'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">الهاتف</label>
                    <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($contrat['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">العنوان</label>
                    <select name="adresse_id" class="form-select">
                        <option value="">-- اختر --</option>
                        <?php foreach ($adresses as $a): ?>
                        <option value="<?= (int)$a['id'] ?>" <?= (int)($contrat['adresse_id'] ?? 0) === (int)$a['id'] ? 'selected' : '' ?>><?= htmlspecialchars($a['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">الدائرة</label>
                    <select name="arrondissement_id" class="form-select">
                        <option value="">-- اختر --</option>
                        <?php foreach ($arrondissements as $a): ?>
                        <option value="<?= (int)$a['id'] ?>" <?= (int)($contrat['arrondissement_id'] ?? 0) === (int)$a['id'] ? 'selected' : '' ?>><?= htmlspecialchars($a['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">النشاط</label>
                    <select name="activite_id" class="form-select">
                        <option value="">-- اختر --</option>
                        <?php foreach ($activites as $a): ?>
                        <option value="<?= (int)$a['id'] ?>" <?= (int)($contrat['activite_id'] ?? 0) === (int)$a['id'] ? 'selected' : '' ?>><?= htmlspecialchars($a['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">الفئة</label>
                    <select name="categorie_id" class="form-select">
                        <option value="">-- اختر --</option>
                        <?php foreach ($categories as $c): ?>
                        <option value="<?= (int)$c['id'] ?>" <?= (int)($contrat['categorie_id'] ?? 0) === (int)$c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['libelle'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">تاريخ العقد</label>
                    <input type="date" name="date_contrat" class="form-control" value="<?= htmlspecialchars($contrat['date_contrat'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">تاريخ البداية</label>
                    <input type="date" name="date_debut" class="form-control" value="<?= htmlspecialchars($contrat['date_debut'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">تاريخ النهاية</label>
                    <input type="date" name="date_fin" class="form-control" value="<?= htmlspecialchars($contrat['date_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">المبلغ</label>
                    <input type="number" step="0.01" name="montant" class="form-control" value="<?= htmlspecialchars($contrat['montant'] ?? '0', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">المبلغ المدفوع</label>
                    <input type="number" step="0.01" name="montant_paye" class="form-control" value="<?= htmlspecialchars($contrat['montant_paye'] ?? '0', ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">الحالة</label>
                    <select name="statut" class="form-select">
                        <option value="unsigned" <?= ($contrat['statut'] ?? 'unsigned') === 'unsigned' ? 'selected' : '' ?>>غير موقّع</option>
                        <option value="signed" <?= ($contrat['statut'] ?? '') === 'signed' ? 'selected' : '' ?>>موقّع</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">ملاحظة</label>
                    <textarea name="observation" class="form-control" rows="3"><?= htmlspecialchars($contrat['observation'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="index.php?page=contrats" class="btn btn-secondary me-2">إلغاء</a>
                </div>
            </div>
        </form>
    </div>
</div>
