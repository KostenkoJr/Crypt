<?php

require_once __DIR__ . '/functions.php';


$out_s1 = [4, 6, 6, 3, 1, 3, 7, 4, 5, 1, 5, 7, 2, 0, 0, 2]; // Выход блока S1
$out_s2 = [6, 3, 6, 0, 4, 1, 7, 2, 3, 5, 1, 7, 2, 4 ,0, 5]; // Выход блока S2
$out_s3 = [0, 1, 0, 1, 0, 2, 2, 2, 2, 1, 0, 1, 3, 3, 3, 3]; // Выход блока S3

for ($i = 0; $i < 16; $i++)
{
    $out_s1_binary[]  = binarView3(decbin($out_s1[$i]));
}

/** Вход 1 и Вход 2 */

$in_s1 = [];
for ($i = 0; $i < 16; $i++)
{
    $in_s1[] = binarView4(decbin($i));
}

/** Delta A*/

$delta_A = $in_s1;


$result = [];

for ($d = 0; $d < 16; $d++) {
    /** Вход 2*/

    $in2_s1 = [];
    for ($i = 0; $i < 16; $i++) {
        $in2_s1[] = xorNum($in_s1[$i], $delta_A[$d]);
    }

    /** Выход 2 Строка*/

    $out2_s1 = [];
    for ($i = 0; $i < 16; $i++) {
        $key = array_search($in2_s1[$i], $in_s1);
        $out2_s1[] = $out_s1_binary[$key];
    }

    /** delta C*/

    $delta_C = [];
    for ($i = 0; $i < 16; $i++) {
        $delta_C[] = xorNum($out_s1_binary[$i], $out2_s1[$i]);
    }

    var_dump($delta_C);


}

