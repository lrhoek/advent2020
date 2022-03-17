<?php

function total_any(string $group): int
{
    return count(array_unique(str_split(preg_replace("/\s+/", "", $group))));
}

function total_every(string $group): int
{
    return count(array_intersect(...array_map(str_split(...), explode(PHP_EOL, $group))));
}

$groups = explode(PHP_EOL.PHP_EOL, file_get_contents('input'));

echo array_sum(array_map(total_any(...), $groups)).PHP_EOL;
echo array_sum(array_map(total_every(...), $groups)).PHP_EOL;