<?php

declare(strict_types = 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Не допустимый HTTP метод!");
}

$firstName = htmlspecialchars($_POST['first_name']);
$secondName = htmlspecialchars($_POST['second_name']);
$middleName = htmlspecialchars($_POST['middle_name']);
$dateOfBirth = htmlspecialchars($_POST['date_of_birth']);
$password = htmlspecialchars($_POST['password']);

$pdo = getDB();
$stmt = $pdo->prepare(
    "INSERT INTO users (first_name, second_name, middle_name, date_of_birth, password) 
    VALUES (:first_name, :second_name, :middle_name, :date_of_birth, :password)"
);
$stmt->execute([$firstName, $secondName, $middleName, $dateOfBirth, $password]);

echo '<p class="success">Пользователь добавлен!</p>';