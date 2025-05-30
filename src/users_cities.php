<?php

declare(strict_types = 1);

const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';

$pdo = getDB();

$sql = <<<SQL
    SELECT *
    FROM users
    ORDER BY users.id;
SQL;

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();

$sql = <<<SQL
    SELECT *
    FROM cities
    ORDER BY cities.id;
SQL;

$iterator = $pdo->query($sql);
$cities = [];
while ($city = $iterator->fetch()) {
    $cities[$city['id']] = $city;
}

$sql = <<<SQL
    SELECT *
    FROM users_cities;
SQL;

$iterator = $pdo->query($sql);

$usersCities = [];

while ($row = $iterator->fetch()) {
    $userId = $row['user_id'];
    $cityId = $row['city_id'];

    if (!isset($usersCities[$userId])) {
        $usersCities[$userId] = [];
    }
    $usersCities[$userId][] = $cityId;
}

$result = [];

foreach ($users as $user) {
    if (!array_key_exists($user["id"], $result)) {
        $result[$user['id']] = [
            'id' => $user['id'],
            'fio' => implode(
                ' ',
                [
                    $user['second_name'] ?? '',
                    $user['first_name'] ?? '',
                    $user['middle_name'] ?? '',
                ]
            ),
        ];
    }
    $citiesId = $usersCities[$user["id"]] ?? [];
    foreach ($citiesId as $cityId) {
        $result[$user['id']]['cities'][] = $cities[$cityId];
    }
}
