<?php

declare(strict_types = 1);

if (!defined('HOGWARTS_INIT')) {
    die("Доступ запрещён! ЛОЛ!");
}

require_once '/var/www/public/include/constants.php';

function getDB(): PDO
{
    static $db = null;

    if ($db === null) {
        try {
            $db = new PDO(
                sprintf("pgsql:host=%s;port=%s;dbname=%s;", DB_HOST, DB_PORT, DB_NAME),
                DB_USER,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к БД: " . $e->getMessage());
        }
    }

    return $db;
}
