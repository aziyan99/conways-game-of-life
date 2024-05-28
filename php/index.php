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

function display()
{
    global $front;
    for ($y = 0; $y < ROWS; $y++) {
        for ($x = 0; $x < COLS; $x++) {
            if ($front[$y][$x]) {
                printf("#"); 
            } else {
                printf("."); 
            }
        }
        printf("\n"); 
    }
}

function mod ($a, $b)
{
    return ($a % $b + $b) % $b;
}

function count_nbors ($cx, $cy)
{
    global $front;
    $nbors = 0;
    for ($dx = -1; $dx <= 1; $dx++){
        for ($dy = -1; $dy <= 1; $dy++){
            if (!($dx == 0 && $dy == 0)) {
                $x = mod($cx + $dx, COLS); 
                $y = mod($cy + $dy, ROWS); 
                if($front[$y][$x]){
                    $nbors += 1; 
                } 
            }
        }
    }
    return $nbors;
}
                    

function next_state ()
{
    global $front;
    global $back;
    for ($y = 0; $y < ROWS; $y++) {
        for ($x = 0; $x < COLS; $x++) {
            $nbors = count_nbors($x, $y);
            if ($front[$y][$x]) {
                $back[$y][$x] = $nbors == 2 || $nbors == 3; 
            } else {
                $back[$y][$x] = $nbors == 3; 
            }
        }
    }   
}


// Glider 2
//   012
// 0 ..*
// 1 *.*
// 2 .**
$front[0][2] = true;
$front[1][0] = true;
$front[1][2] = true;
$front[2][1] = true;
$front[2][2] = true;

$front[13][2] = true;
$front[14][0] = true;
$front[14][2] = true;
$front[15][1] = true;
$front[15][2] = true;


for (;;) {
    display();
    next_state();
    
    $front = $back;

    usleep(150 * 1000);

    printf("\033[%dA\033[%dD", ROWS, COLS);

}

