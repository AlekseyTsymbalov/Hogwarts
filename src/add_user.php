<?php

declare(strict_types = 1);
const HOGWARTS_INIT = true;

require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Не допустимый HTTP метод!");
}

$firstName = htmlspecialchars($_POST['first_name'] ?? "");
$secondName = htmlspecialchars($_POST['second_name'] ?? "");
$middleName = htmlspecialchars($_POST['middle_name'] ?? "");
$dateOfBirth = htmlspecialchars($_POST['date_of_birth'] ?? "");
$email = htmlspecialchars($_POST['email'] ?? "");
$password = md5(htmlspecialchars($_POST['password'] ?? ""));

if (
    empty($firstName)
    || empty($secondName)
    || empty($middleName)
    || empty($dateOfBirth)
    || empty($email)
    || empty($password)
) {
    die("Заполните пустое поле! Лол.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Вы ввели некорректный адрес почты!");
}
$countEmailSql = <<<SQL
SELECT COUNT(*) FROM users WHERE email = '$email'
SQL;
$pdo = getDB();
$query = $pdo->query($countEmailSql);
$countEmail = $query->fetch();

if ($countEmail["count"] > 0) {
    die("Пользователь с такой почтой уже существует");
}

$sql = <<<SQL
INSERT INTO users (first_name, second_name, middle_name, date_of_birth, email, password) 
    VALUES (:first_name, :second_name, :middle_name, :date_of_birth, :email, :password) 
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$firstName, $secondName, $middleName, $dateOfBirth, $email, $password]);

header("Location: /login.php");