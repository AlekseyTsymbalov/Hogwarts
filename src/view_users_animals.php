<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';

$pdo = getDB();

try {
    $sql = "
        SELECT 
            users.id AS user_id,
            users.first_name,
            users.second_name,
            users.middle_name,
            animals.id AS animal_id,
            animals.name AS animal_name,
            animals.type AS animal_type
        FROM users
        LEFT JOIN animals ON animals.owner_id = users.id
        ORDER BY users.id";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    $users = [];

    foreach ($results as $result) {
        if (!array_key_exists($result["user_id"], $users)) {
            $users[$result['user_id']] = [
                'user_id' => $result['user_id'],
                'fio' => trim(
                    sprintf(
                        "%s %s %s",
                        $result['first_name'],
                        $result['second_name'],
                        $result['middle_name']
                    )
                ),
                'fio_2' => implode(
                    ' ',
                    [
                        $result['second_name'],
                        $result['first_name'],
                        $result['middle_name'],
                    ]
                ),
            ];

        }
        if ($result['animal_id']) {
            $users[$result['user_id']]['animals'][] = [
                'animal_type' => $result['animal_type'],
                'animal_name' => $result['animal_name'],
            ];
        }
    }

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
                <th>ФИО</th>
                <th>Животные</th>
            </tr>';

    foreach ($users as $user) {
        echo '<tr>
            <td>' . $user['user_id'] . '</td>
            <td>' . $user['fio_2'] . '</td>
            <td>';

        if (!empty($user['animals'])) {
            foreach ($user['animals'] as $animal) {
                echo $animal['animal_name'] . ' (' .
                    $animal['animal_type']
                    . ')<br>';
            }
        } else {
            echo 'Нет животных';
        }

        echo '</td></tr>';
    }

    echo '</table>
    </body>
    </html>';

} catch (PDOException $e) {
    die("Ошибка при выполнении запроса: " . $e->getMessage());
}