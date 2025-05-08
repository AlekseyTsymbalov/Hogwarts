<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';

try {
    $pdo = getDB();

    $stmt = $pdo->query("SELECT 1");
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
        form {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid black;
        }
        input {
            margin: 5px 0;
            display: block;
            padding: 8px;
        }
    </style>
</head>
<body>
<h1>Добро пожаловать в Hogwarts!</h1>
<form method="post" action="add_user.php">
    <h2>Добавить пользователя</h2>
    <input type="text" name="first_name" placeholder="Имя" required>
    <input type="text" name="second_name" placeholder="Фамиля" required>
    <input type="text" name="middle_name" placeholder="Отчество" required>
    <input type="text" name="date_of_birth" placeholder="Дата рождения" required>
    <input type="email" name="email" placeholder="Почта" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Отправить</button>
</form>
<p>Здесь начинаются ваши знания.</p>
<?php
    $query = $pdo->query("SELECT * FROM users");
    $count = 1;
    while ($row = $query->fetch()) {
        echo "Пользователь: $count<br>";
        echo sprintf("Имя: %s<br>", $row['first_name']);
        echo sprintf("Фамилия: %s<br>", $row['second_name']);
        echo sprintf("Отчество: %s<br>", $row['middle_name']);
        echo sprintf("День Рожденья: %s<br>", $row['date_of_birth']);
        echo sprintf("Ваша почта: %s<br>", $row['email']);
        echo sprintf("Пароль: %s<br>", $row['password']);
        echo sprintf("Дата создания: %s<br><br>", $row['created_at']);
        $count++;
    }
?>

</body>
</html>
