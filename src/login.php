<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getDB();
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    }

    die("Неверный email или пароль!!!");
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

    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <p>Ещё нет аккаунта? <a href="index.php">Зарегистрируйтесь</a></p>
</div>
</body>
</html>
