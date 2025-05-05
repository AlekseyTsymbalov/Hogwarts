<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/../config/db.php';

try {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT 1");
    echo "<h1>Ошщибка подключения</h1>";
} catch (PDOException $e) {
    echo "<h1>Ошибка подключения: </h1>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>

<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hogwarts | Главная</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>Добро пожаловать в Hogwarts!</h1>
<p>Здесь начинаются ваши знания.</p>
</body>
</html>
