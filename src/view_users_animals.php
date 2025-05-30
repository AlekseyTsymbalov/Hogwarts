<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/services/userRepository.php';

try {
    $pdo = getDB();
    $users = getUsersWithAnimals($pdo);
} catch (PDOException $e) {
    die("Ошибка при выполнении запроса: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользователи и их животные</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<h1>Пользователи и их животные</h1>
<table>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Животные</th>
    </tr>
    <?php
    foreach ($users as $user): ?>
        <tr>
            <td><?= $user['user_id'] ?></td>
            <td><?= $user['fio'] ?></td>
            <td>
                <?php
                if (!empty($user['animals'])): ?>
                    <?php
                    foreach ($user['animals'] as $animal): ?>
                        <?= $animal['animal_name'] ?>
                        (<?= $animal['animal_type'] ?>)
                        <br>
                    <?php
                    endforeach; ?>
                <?php
                else: ?>
                    Нет животных
                <?php
                endif; ?>
            </td>
        </tr>
    <?php
    endforeach; ?>
</table>
</body>
</html>