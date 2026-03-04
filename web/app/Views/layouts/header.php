<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GcontratPN - نظام إدارة العقود</title>
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<?php if (!empty($_SESSION['user_id'])): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard">
            <i class="fas fa-file-contract me-2"></i>GcontratPN
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=dashboard"><i class="fas fa-tachometer-alt me-1"></i>لوحة التحكم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=contrats"><i class="fas fa-file-contract me-1"></i>العقود</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-cogs me-1"></i>الإعدادات</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?page=activites"><i class="fas fa-briefcase me-2"></i>الأنشطة</a></li>
                        <li><a class="dropdown-item" href="index.php?page=adresses"><i class="fas fa-map-marker-alt me-2"></i>العناوين</a></li>
                        <li><a class="dropdown-item" href="index.php?page=arrondissements"><i class="fas fa-map me-2"></i>الدوائر</a></li>
                        <li><a class="dropdown-item" href="index.php?page=categories"><i class="fas fa-tags me-2"></i>الفئات</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-print me-1"></i>التقارير</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?page=rapports&action=liste"><i class="fas fa-list me-2"></i>قائمة العقود</a></li>
                        <li><a class="dropdown-item" href="index.php?page=rapports&action=stats"><i class="fas fa-chart-bar me-2"></i>الإحصائيات</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i><?= htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li><a class="dropdown-item" href="index.php?page=auth&action=change_password"><i class="fas fa-key me-2"></i>تغيير كلمة المرور</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="post" action="index.php?page=auth&action=logout" class="d-inline">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>خروج</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
<main class="container-fluid py-4">
