<?php

declare(strict_types = 1);

//Task_1
$fruits = ['apple', 'banana', 'orange', 'grape', 'pear'];
//echo $fruits[0] . '<br>';
//echo $fruits[1] . '<br>';
//echo $fruits[2] . '<br>';
//echo $fruits[3] . '<br>';
//echo $fruits[4] . '<br>';

$fruits[2] = 'mango';
print implode(' ', $fruits);


for ($i = count($fruits) - 1; $i >= 0; $i--) {
    echo $fruits[$i] . "<br>";
}

//Task_2