<?php

function find_empty(array $seats) {
    $current = array_shift($seats);
    return in_array($current-2, $seats) && !in_array($current-1, $seats) ? $current-1 : find_empty($seats);
}

$passes = explode(PHP_EOL, file_get_contents('input'));
$passes = array_map(fn($pass) => bindec(str_replace(['B', 'F', 'R', 'L'], ['1', '0', '1', '0'], $pass)), $passes);
rsort($passes);

echo reset($passes).PHP_EOL;
echo find_empty($passes).PHP_EOL;