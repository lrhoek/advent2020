<?php

function findSum(array $numbers, int $sum) : array {
    $current = array_pop($numbers);
    $check = $sum - $current;
    return in_array($check, $numbers) ? [(int) $current, $check] : (empty($numbers) ? [] : findSum($numbers, $sum));
}

function findSumOfThree(array $numbers, int $sum) : array {
    $check = array_pop($numbers);
    $found = findSum($numbers, $sum - $check);
    return !empty($found) ? [(int) $check, ...$found] : findSumOfThree($numbers, $sum);
}

$numbers = explode(PHP_EOL, file_get_contents('input'));

echo array_product(findSum($numbers, 2020)).PHP_EOL;
echo array_product(findSumOfThree($numbers, 2020)).PHP_EOL;