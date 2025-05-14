<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';

$pdo = getDB();

try {
    $sql = "
        SELECT users.first_name, animals.name, animals.type 
        FROM users
        LEFT JOIN animals
        ON animals.owner_id = users.id
        ORDER BY users.first_name";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();

    echo '<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Пользователи и их животные</title>
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            tr:nth-child(even) { background-color: #f9f9f9; }
        </style>
    </head>
    <body>
        <h1>Пользователи и их животные</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Животные</th>
            </tr>';

    $currentUser = null;
    foreach ($results as $row) {
        if ($currentUser !== $row['user_id']) {
            if ($currentUser !== null) {
                echo '</td></tr>';
            }
            echo '<tr>
                <td>' . htmlspecialchars($row['user_id']) . '</td>
                <td>' . htmlspecialchars($row['first_name']) . '</td>                
                <td>';

            $currentUser = $row['user_id'];
        }

        if ($row['animal_id']) {
            echo htmlspecialchars($row['animal_name']) . ' (' . htmlspecialchars($row['animal_type']) . ')<br>';
        }
    }

    if ($currentUser !== null) {
        echo '</td></tr>';
    }
    echo '</table>
    </body>
    </html>';

} catch (PDOException $e) {
    die("Ошибка при выполнении запроса: " . htmlspecialchars($e->getMessage()));
}