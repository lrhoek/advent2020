<?php

function findSum($numbers, $sum) {
    $check = array_pop($numbers);
    $found = in_array($sum - $check, $numbers);
    return ($found ? [(int) $check, $sum - $check] : (empty($numbers) ? [] : findSum($numbers, $sum)));
}

function findSumOfThree($numbers, $sum) {
    $check = array_pop($numbers);
    $found = findSum($numbers, $sum - $check);
    return (!empty($found) ? array_merge([(int) $check], $found) : findSumOfThree($numbers, $sum));
}

$numbers = explode(PHP_EOL, file_get_contents('input'));

echo array_product(findSum($numbers, 2020)).PHP_EOL;

echo array_product(findSumOfThree($numbers, 2020)).PHP_EOL;
