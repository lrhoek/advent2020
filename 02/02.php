<?php

function password_map(string $entry) : array {
    preg_match("/(?<min>\d+)-(?<max>\d+) (?<character>[a-z]): (?<password>[a-z]+)/", $entry, $password);
    return $password;
}

function password_valid(array $entry) : bool {
    $count = substr_count($entry['password'], $entry['character']);
    return $count >= $entry['min'] && $count <= $entry['max'];
}

function password_valid_otcp(array $entry) : bool {
    return $entry['password'][$entry['min']-1] === $entry['character'] xor $entry['password'][$entry['max']-1] === $entry['character'];
}

$passwords = array_map(password_map(...), explode(PHP_EOL, file_get_contents('input')));

echo count(array_filter($passwords, password_valid(...))).PHP_EOL;
echo count(array_filter($passwords, password_valid_otcp(...))).PHP_EOL;
