<?php
require 'db.php';
require 'check_admin.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $price = $_POST['price'];
    $desc  = trim($_POST['description']);
    $img   = trim($_POST['image_url']);

    if (empty($title)) {
        $message = '<div class="alert alert-danger">Заполните название!</div>';
    } else {
        $sql  = "INSERT INTO products (title, description, price, image_url) VALUES (:t, :d, :p, :i)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':t' => $title, ':d' => $desc, ':p' => $price, ':i' => $img]);
        $message = '<div class="alert alert-success">Товар успешно добавлен!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f1117; }
        .card { background-color: #1a1d27; border: 1px solid #2e3250; }
    </style>
</head>
<body class="p-4">
    <div class="container" style="max-width: 600px;">
        <h1 class="text-white mb-1">Новый товар</h1>
        <a href="admin_panel.php" class="btn btn-outline-secondary btn-sm mb-4">← Назад в панель</a>

        <?= $message ?>

        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label class="form-label text-secondary">Название <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Название товара" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-secondary">Цена (₽)</label>
                <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label text-secondary">URL картинки</label>
                <input type="text" name="image_url" class="form-control" placeholder="https://...">
            </div>
            <div class="mb-3">
                <label class="form-label text-secondary">Описание</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Описание товара"></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Сохранить</button>
        </form>
    </div>
</body>
</html>
