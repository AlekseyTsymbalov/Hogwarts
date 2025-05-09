<?php

declare(strict_types = 1);

require_once __DIR__ . '/config/db.php';

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        $error = "Неверный email или пароль!!!";
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация в Хогвартс</title>
</head>
<body>
<div class="container">
    <h2>Вход в Хогвартс</h2>
    <?php
    if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php
    endif; ?>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <p>Ещё не таккаунта? <a href="add_user.php">Зарегестрируйтесь</a></p>
</div>
</body>
</html>
