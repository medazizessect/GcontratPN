<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GcontratPN - نظام إدارة العقود</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
</head>
<body>
<?php if (!empty($_SESSION['user_id'])): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard">GcontratPN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=dashboard">لوحة التحكم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=contrats">العقود</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=activites">الأنشطة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=adresses">العناوين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=arrondissements">الدوائر</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=categories">الفئات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=rapports&action=liste">التقارير</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-white"><?= htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=auth&action=change_password">تغيير كلمة المرور</a>
                </li>
                <li class="nav-item">
                    <form method="post" action="index.php?page=auth&action=logout" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="btn btn-link nav-link text-danger">خروج</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
<main class="container-fluid py-4">
