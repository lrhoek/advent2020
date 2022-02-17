<?php

function count_trees(array $map, $step_x, $step_y, $x = 0, $y = 0) : int {
    $tree = empty($map[$x]) ? 0 : (int) (substr($map[$x], $y % strlen($map[$x]), 1) === "#");
    return $x >= count($map) ? $tree : $tree + count_trees($map, $step_x, $step_y, $x + $step_x, $y + $step_y);
}

$map = explode(PHP_EOL, file_get_contents('input'));
echo count_trees($map, 1, 3) . PHP_EOL;

$options = [[1,1], [1,3], [1,5], [1,7], [2,1]];
echo array_product(array_map(fn ($option) => count_trees($map, $option[0], $option[1]), $options)).PHP_EOL;