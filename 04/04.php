<?php

$passports = explode(PHP_EOL.PHP_EOL, file_get_contents('input'));
$required_fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
echo count(array_filter($passports, fn ($passport) => array_reduce($required_fields, fn ($valid, $field) => $valid && strstr($passport, $field.":"), true))).PHP_EOL;

$validations = [
    "/byr:(19[2-9]\d|200[0-2])(\s|$)/",
    "/iyr:20(1\d|20)(\s|$)/",
    "/eyr:20(2\d|30)(\s|$)/",
    "/hgt:(1([5-8]\d|9[0-3])cm|(59|6\d|7[0-6])in)(\s|$)/",
    "/hcl:#[0-9a-f]{6}(\s|$)/",
    "/ecl:(amb|blu|brn|gry|grn|hzl|oth)(\s|$)/",
    "/pid:\d{9}(\s|$)/"
];
echo count(array_filter($passports, fn($passport) => array_reduce($validations, fn ($valid, $validation) => $valid && preg_match($validation, $passport), true))).PHP_EOL;