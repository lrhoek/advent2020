<?php

function rules($rules, $rule) {
    preg_match_all("/(?<amount>\d) (?<type>\w+ \w+)/", $rule, $contents, PREG_SET_ORDER);
    $rules[explode(" bags", $rule)[0]] = array_map(fn ($content) => ["type" => $content["type"], "amount" => $content["amount"]], $contents);
    return $rules;
}

function contains($rules, $rule, $search) {
    return array_reduce(array_column($rules[$rule], "type"), fn ($found, $type) => $found || contains($rules, $type, $search), in_array($search, array_column($rules[$rule], "type")));
}

function content_count($rules, $type) {
    return array_reduce($rules[$type], fn ($count, $item) => $count + $item["amount"] * (1 + content_count($rules, $item["type"])),0);
}

$rules = explode(PHP_EOL, file_get_contents('input'));
$rules = array_reduce($rules, rules(...), []);

echo count(array_filter(array_keys($rules), fn ($rule) => contains($rules, $rule, 'shiny gold'))).PHP_EOL;
echo content_count($rules, 'shiny gold').PHP_EOL;