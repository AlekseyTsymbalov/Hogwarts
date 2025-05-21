<?php

declare(strict_types = 1);

//Task_1
//$fruits = ['apple', 'banana', 'orange', 'grape', 'pear'];
//echo $fruits[0] . '<br>';
//echo $fruits[1] . '<br>';
//echo $fruits[2] . '<br>';
//echo $fruits[3] . '<br>';
//echo $fruits[4] . '<br>';

//$fruits[2] = 'mango';
//print implode(' ', $fruits);
//for ($i = count($fruits) - 1; $i >= 0; $i--) {
//    echo $fruits[$i] . "<br>";
//}

//Task_2
//$users = [
//    ['name' => 'Alice', 'age' => 25, 'email' => 'alice@example.com'],
//    ['name' => 'Bob', 'age' => 30, 'email' => 'bob@example.com'],
//    ['name' => 'Charlie', 'age' => 28, 'email' => 'charlie@example.com'],
//    ['name' => 'Diana', 'age' => 22, 'email' => 'diana@example.com'],
//];
//foreach ($users as $user) {
//    echo "Имя: " . $user['name'] . ", Email: " . $user['email'] . "<br>";
//}
//echo "-------------------------------------------------------------------------------<br>";
//Вывод без цикла foreach
//$users_01 = [
//    ['name' => 'Alice', 'age' => 25, 'email' => 'alice@example.com'],
//    ['name' => 'Bob', 'age' => 30, 'email' => 'bob@example.com'],
//    ['name' => 'Charlie', 'age' => 28, 'email' => 'charlie@example.com'],
//    ['name' => 'Diana', 'age' => 22, 'email' => 'diana@example.com'],
//];
//echo "1. " . $users_01[0]['name'] . ", Email: " . $users_01[0]['email'] . "<br>";
//echo "2. " . $users_01[1]['name'] . ", Email: " . $users_01[1]['email'] . "<br>";
//echo "3. " . $users_01[2]['name'] . ", Email: " . $users_01[2]['email'] . "<br>";
//echo "4. " . $users_01[3]['name'] . ", Email: " . $users_01[3]['email'] . "<br>";
//
//echo "-------------------------------------------------------------------------------<br>";
//Или так с циклом for
//$usersCount = count($users_01);
//for ($i = 0; $i <= count($users_01) -1; $i++) {
//    echo ($i + 1) . ". " . $users_01[$i]['name'] . " - " . $users_01[$i]['email'] . "<br>";
//}

//foreach ($users as &$user) {
//    $user['city'] = 'Moscow';
//}
//unset($user);
//
//echo '<pre>';
//print_r($users);
//echo '</pre>';
//
//echo "-------------------------------------------------------------------------------<br>";
//
//foreach ($users as $user) {
//    echo $user['name'] . ' (' . $user['age'] . '): ' . $user['email'] . '<br>';
//}

//$output = [];
//foreach ($users as $user) {
//    $output[] = sprintf("%s (%s): %s", $user['name'], $user['age'], $user['email']);
//}
//echo implode("<br>", $output);

//Task_3 Циклы foreach, for, while для массивов

$numbers = [3, 7, 10, 5, 12, 18, 21, 4, 9, 15];
foreach ($numbers as $number) {
    echo "Число: {$number} <br>";
}
echo "--------------------------------------------<br>";

//for
$length = count($numbers);
for ($i = 0; $i < $length; $i++) {
    $number = $numbers[$i];
    $square = $number * $number; //В Python так работало
    echo "Индекс: $i, число: $number, квадрат числа: $square<br>";
}
echo "--------------------------------------------<br>";

//while
//условие