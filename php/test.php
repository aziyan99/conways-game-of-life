<?php

define('ROWS', 16);
define('COLS', 32);

$front = [];
$back = [];

for ($y = 0; $y < ROWS; $y++) {
    $init_value = array();
    for ($x = 0; $x < COLS; $x++) {
        array_push($init_value, false);          
    }
    array_push($front, $init_value);
    array_push($back, $init_value);
}

var_dump($front);
