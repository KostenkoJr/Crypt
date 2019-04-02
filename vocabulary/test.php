<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/top_functions.php';

/** Выход 1 */

$out_s1 = [4, 6, 6, 3, 1, 3, 7, 4, 5, 1, 5, 7, 2, 0, 0, 2]; // Выход блока S1
$out_s2 = [6, 3, 6, 0, 4, 1, 7, 2, 3, 5, 1, 7, 2, 4 ,0, 5]; // Выход блока S2
$out_s3 = [0, 1, 0, 1, 0, 2, 2, 2, 2, 1, 0, 1, 3, 3, 3, 3]; // Выход блока S3
$PE = [6, 7, 4, 1, 3, 2, 5, 8, 6, 4, 7, 1];

/** ---------------------------------------------------------------------------------------- */


/** Вход 1*/

$in_s1 = [];
for ($i = 0; $i < 16; $i++)
{
    $in_s1[] = binarView4(decbin($i));
}

/** ----------------------------------------------------S1---------------------------------------------- */

/** Получаем delta A и delta C для каждого S-блока*/
$s1_block = deltaA(s_Block($out_s1));
$s2_block = deltaA(s_Block($out_s2));
$s3_block = deltaA(s_Block3($out_s3));
var_dump($s3_block);

/** Массив со значениями delta C для определенного delta A (второй параметр) для S1*/
$arr_delta_C_S1 = s_Block_delta_C($out_s1, 15);




/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S1 as $key => $value)
{
    if ($value == 110)
        $arr_index[] = $key;
}

/** Пары текстов XR */

$xr = read_savetxt_xr();


/** Массив с первыми четырьмя битами текста XR после перестановки с расширением */

$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 0, 4);
}

/** Массив с подключами для S1 */
$arr_K1 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K1[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S1' . '</h2>';
var_dump(array_count_values($arr_K1));


/** ---------------------------------------------------- S2 ---------------------------------------------- */

/** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
$arr_delta_C_S2 = s_Block_delta_C($out_s2, 5);

/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S2 as $key => $value)
{
    if ($value == 111)
        $arr_index[] = $key;
}
$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 4, 4);
}

/** Массив с подключами для S2 */

$arr_K2 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K2[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S2' . '</h2>';
var_dump(array_count_values($arr_K2));


/** ---------------------------------------------------- S3 ---------------------------------------------- */

/** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
$arr_delta_C_S3 = s_Block_delta_C_S3($out_s3, 11);

/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S3 as $key => $value)
{
    if ($value == '01')
        $arr_index[] = $key;
}


$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 8, 4);
}

/** Массив с подключами для S2 */

$arr_K3 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K3[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S3' . '</h2>';
var_dump(array_count_values($arr_K3));

/** _____________________________________________________________________YR_______________________________________________________________________________ */


/** ----------------------------------------------------S1---------------------------------------------- */

/** Получаем delta A и delta C для каждого S-блока*/
$s1_block = deltaA(s_Block($out_s1));
$s2_block = deltaA(s_Block($out_s2));
$s3_block = deltaA(s_Block3($out_s3));

/** Массив со значениями delta C для определенного delta A (второй параметр) для S1*/
$arr_delta_C_S1 = s_Block_delta_C($out_s1, 15);

/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S1 as $key => $value)
{
    if ($value == 110)
        $arr_index[] = $key;
}

/** Пары текстов XR */

$xr = read_savetxt_yr();


/** Массив с первыми четырьмя битами текста XR после перестановки с расширением */

$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 0, 4);
}

/** Массив с подключами для S1 */
$arr_K1 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K1[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S1' . '</h2>';
var_dump(array_count_values($arr_K1));


/** ---------------------------------------------------- S2 ---------------------------------------------- */

/** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
$arr_delta_C_S2 = s_Block_delta_C($out_s2, 5);

/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S2 as $key => $value)
{
    if ($value == 111)
        $arr_index[] = $key;
}
$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 4, 4);
}

/** Массив с подключами для S2 */

$arr_K2 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K2[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S2' . '</h2>';
var_dump(array_count_values($arr_K2));


/** ---------------------------------------------------- S3 ---------------------------------------------- */

/** Массив со значениями delta C для определенного delta A (второй параметр) для S2*/
$arr_delta_C_S3 = s_Block_delta_C_S3($out_s3, 11);

/** Массив с индексами для Входа 1, где значение delta C подходит нам */
$arr_index = [];
foreach ($arr_delta_C_S3 as $key => $value)
{
    if ($value == '01')
        $arr_index[] = $key;
}


$bits_4_XR = [];
foreach ($xr as $value)
{
    $bits_4_XR[] = substr(permitation($value,'463215874163'), 8, 4);
}

/** Массив с подключами для S2 */

$arr_K3 = [];
for ($i = 0; $i < count($bits_4_XR); $i++) {
    foreach ($arr_index as $value) {
        $arr_K3[] = xorNum($in_s1[$value], $bits_4_XR[$i]);
    }
}
echo '<h2>' . 'S3' . '</h2>';
var_dump(array_count_values($arr_K3));

die();


/*

$result = [];

foreach ($arr1 as $item)
{
    foreach ($arr2 as $value)
    {
        foreach ($arr3 as $v)
        {
            $result[] = $item . $value . $v;
        }
    }
}

$p = permutation($PE);

foreach ($result as $key => $res)
{
    for ($i = 0; $i < 8; $i = $i + 2)
    {
        if ($res[$p[$i]] != $res[$p[$i + 1]])
        {
            array_splice($result, $key, 1);
            break;
        }
    }

}

var_dump($result);
*/
die();







