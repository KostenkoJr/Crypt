<?php
require_once __DIR__ . '/functions.php';

/** Выход 1 */

$out_s1 = [6, 0, 7, 6, 0, 4, 1, 1, 4, 5, 5, 3, 2, 2, 7, 3]; // Выход блока S1
$out_s2 = [4, 0, 1, 4, 0, 7, 3, 5, 3, 5, 7, 6, 2, 1, 6, 2]; // Выход блока S2
$out_s3 = [2, 0, 0, 2, 3, 2, 2, 1, 0, 1, 0, 3, 1, 3, 3, 1]; // Выход блока S3
$PE = [6, 7, 4, 1, 3, 2, 5, 8, 6, 4, 7, 1];

/** ---------------------------------------------------------------------------------------- */


/** Вход 1*/

$in_s1 = [];
for ($i = 0; $i < 16; $i++)
{
    $in_s1[] = binarView4(decbin($i));
}


$xr = read_savetxt_xr();
/** ----------------------------------------------------S1---------------------------------------------- */

/** Получаем delta A и delta C для каждого S-блока*/
$s1_block = deltaA(s_Block($out_s1));
$s2_block = deltaA(s_Block($out_s2));
$s3_block = deltaA(s_Block3($out_s3));
var_dump($s1_block);
var_dump($s2_block);
var_dump($s3_block);

echo '<h1>' . 'XR' . '</h1>';
/** Массив со значениями delta C для определенного delta A (второй параметр) для S1*/
$arr_delta_C_S1 = s_Block_delta_C($out_s1, 10);


$arr_index = [];
foreach ($arr_delta_C_S1 as $key => $value)
{
    if ($value == '011')
        $arr_index[] = $key;
}



$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'674132586471'), 0, 4);
}

/** Массив с подключами для S1 */
$arr_K1 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K1[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo 'S1';
var_dump(array_count_values($arr_K1));

/** ---------------------------------------------------- S2 ---------------------------------------------- */
/** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
$arr_delta_C_S2 = s_Block_delta_C($out_s2, 15);

$arr_index = [];
foreach ($arr_delta_C_S2 as $key => $value)
{
    if ($value == 110)
        $arr_index[] = $key;
}


$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'674132586471'), 4, 4);
}


$arr_K2 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K2[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo 'S2';
var_dump(array_count_values($arr_K2));
/** ---------------------------------------------------- S3 ---------------------------------------------- */
$arr_delta_C_S3 = s_Block_delta_C_S3($out_s3, 12);

$arr_index = [];
foreach ($arr_delta_C_S3 as $key => $value)
{
    if ($value == 11)
        $arr_index[] = $key;
}


$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'674132586471'), 8, 4);
}


$arr_K3 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K3[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo 'S3';
var_dump(array_count_values($arr_K3));

/** _____________________________________________________________________YR_______________________________________________________________________________ */
$arr_K1 = [];
$arr_K2 = [];
$arr_K3 = [];


echo '<h1>' . 'YR' . '</h1>';
$yr = read_savetxt_yr();
$yl = read_savetxt_yl();
/** Массив со значениями delta C для определенного delta A (второй параметр) для S1*/
$arr_delta_C_S1 = s_Block_delta_C($out_s1, 10);

for ($y = 0; $y < count($yr); $y++) {
    $arr_index = [];
    foreach ($arr_delta_C_S1 as $key => $value) {
        if ($value == substr($yl[$y], 0, 3))
            $arr_index[] = $key;
    }


    $bits_4_XR = [];
    foreach ($yr as $value) {
        $bits_4_XR[] = substr(permitation($value, '674132586471'), 0, 4);
    }

    /** Массив с подключами для S1 */

    foreach ($arr_index as $value) {
        $arr_K1[] = xorNum($in_s1[$value], $bits_4_XR[$y]);
    }




    /** ---------------------------------------------------- S2 ---------------------------------------------- */
    /** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
    $arr_delta_C_S2 = s_Block_delta_C($out_s2, 15);


    $arr_index = [];
    foreach ($arr_delta_C_S2 as $key => $value) {
        if ($value == substr($yl[$y], 3, 3))
            $arr_index[] = $key;
    }


    $bits_4_XR = [];
    foreach ($yr as $value) {
        $bits_4_XR[] = substr(permitation($value, '674132586471'), 4, 4);
    }


    foreach ($arr_index as $value) {
        $arr_K2[] = xorNum($in_s1[$value], $bits_4_XR[$y]);
    }

    /** ---------------------------------------------------- S3 ---------------------------------------------- */
    $arr_delta_C_S3 = s_Block_delta_C_S3($out_s3, 12);

    $arr_index = [];
    foreach ($arr_delta_C_S3 as $key => $value) {
        if ($value == substr($yl[$y], 6, 2))
            $arr_index[] = $key;
    }


    $bits_4_XR = [];
    foreach ($yr as $value) {
        $bits_4_XR[] = substr(permitation($value, '674132586471'), 8, 4);
    }

    foreach ($arr_index as $value) {
        $arr_K3[] = xorNum($in_s1[$value], $bits_4_XR[$y]);
    }

}
    echo 'S1';
    var_dump(array_count_values($arr_K1));
    echo 'S2';
    var_dump(array_count_values($arr_K2));
    echo 'S3';
    var_dump(array_count_values($arr_K3));
