<?php

declare(strict_types = 1);

function getUsersWithAnimals(PDO $pdo): array
{
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
                'fio' => implode(
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

    return $users;
}