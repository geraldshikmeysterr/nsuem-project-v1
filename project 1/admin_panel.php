<?php
require 'check_admin.php';
?>
<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f1117; }
        .panel-card { background-color: #1a1d27; border: 1px solid #2e3250; border-radius: 12px; }
    </style>
</head>
<body class="p-5">
    <div class="container" style="max-width: 600px;">
        <div class="panel-card p-4">
            <h1 class="text-white mb-1">Панель Администратора</h1>
            <p class="text-secondary mb-4">Добро пожаловать в систему управления.</p>

            <div class="d-flex gap-2">
                <a href="add_item.php" class="btn btn-primary">Добавить товар</a>
                <a href="index.php" class="btn btn-outline-secondary">На главную</a>
                <a href="logout.php" class="btn btn-outline-danger">Выйти</a>
            </div>
        </div>
    </div>
</body>
</html>
