<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/../config/db.php';

try {
    $pdo = getDB();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = htmlspecialchars($_POST['first_name']);
        $secondName = htmlspecialchars($_POST['second_name']);
        $middleName = htmlspecialchars($_POST['middle_name']);
        $dateOfBirth = htmlspecialchars($_POST['date_of_birth']);
        $password = htmlspecialchars($_POST['password']);

        $stmt = $pdo->prepare(
            "INSERT INTO users (first_name, second_name, middle_name, date_of_birth, password) 
        VALUES (:first_name, :second_name, :middle_name, :date_of_birth, :password)"
        );
        $stmt->execute([$firstName, $secondName, $middleName, $dateOfBirth, $password]);

        echo '<p class="success">Пользователь добавлен!</p>';
    }

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
    </style>
</head>
<body>
<h1>Добро пожаловать в Hogwarts!</h1>
<p>Здесь начинаются ваши знания.</p>
<?php
$query = $pdo->query("SELECT * FROM users");
while ($row = $query->fetch()) {
    echo sprintf("Имя: %s<br>", $row['first_name']);
    echo sprintf("Фамилия: %s<br>", $row['second_name']);
}
?>

</body>
</html>
