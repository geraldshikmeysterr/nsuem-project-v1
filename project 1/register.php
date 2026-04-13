<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);
    $pass2 = trim($_POST['password2']);

    if (empty($email) || empty($pass)) {
        $error = "Заполните все поля.";
    } elseif ($pass !== $pass2) {
        $error = "Пароли не совпадают.";
    } elseif (strlen($pass) < 6) {
        $error = "Пароль должен быть не менее 6 символов.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Этот email уже зарегистрирован.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql  = "INSERT INTO users (email, password_hash, role) VALUES (:email, :hash, 'client')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email, ':hash' => $hash]);
            $success = "Регистрация прошла успешно! <a href='login.php' class='text-info'>Войти</a>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f1117; }
        .card { background-color: #1a1d27; border: 1px solid #2e3250; }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h2 class="mb-4 text-center text-white">Регистрация</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= h($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label text-secondary">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label text-secondary">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-secondary">Повторите пароль</label>
                <input type="password" name="password2" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
        </form>

        <p class="mt-3 text-center text-secondary">Уже есть аккаунт? <a href="login.php" class="text-info">Войти</a></p>
    </div>
</div>
</body>
</html>
