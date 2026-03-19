<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GcontratPN - تسجيل الدخول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        body { background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); min-height:100vh; display:flex; align-items:center; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;">
                            <i class="fas fa-file-contract fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-primary">GcontratPN</h2>
                        <p class="text-muted">نظام إدارة العقود</p>
                    </div>

                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=login">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">اسم المستخدم</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" required autofocus>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">كلمة المرور</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i>دخول
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
