<?php
session_start();
require 'db.php';

$stmt     = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Главная — Каталог товаров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f1117; }
        .navbar { background-color: #1a1d27 !important; border-bottom: 1px solid #2e3250; }
        .card { background-color: #1a1d27; border: 1px solid #2e3250; }
        .card-img-top { border-bottom: 1px solid #2e3250; }
    </style>
</head>
<body>

<nav class="navbar px-4 mb-4">
    <span class="navbar-brand fw-bold text-white">Мой Проект</span>
    <div class="d-flex gap-2">
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="admin_panel.php" class="btn btn-sm btn-outline-danger">Админка</a>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-sm btn-outline-secondary">Выйти</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-sm btn-outline-light">Войти</a>
            <a href="register.php" class="btn btn-sm btn-outline-secondary">Регистрация</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4 text-white">Каталог товаров</h2>

    <?php if (empty($products)): ?>
        <div class="alert alert-secondary">Товаров пока нет. <a href="login.php">Войдите как администратор</a>, чтобы добавить.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($products as $p): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img
                            src="<?= h($p['image_url'] ?: 'https://via.placeholder.com/300x200?text=No+Image') ?>"
                            class="card-img-top"
                            style="height: 200px; object-fit: cover;"
                            alt="<?= h($p['title']) ?>"
                        >
                        <div class="card-body">
                            <h5 class="card-title text-white"><?= h($p['title']) ?></h5>
                            <p class="card-text text-secondary"><?= h($p['description']) ?></p>
                            <p class="fw-bold fs-5 text-info"><?= h((string)$p['price']) ?> ₽</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
