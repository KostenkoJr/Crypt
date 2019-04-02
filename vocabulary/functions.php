<?php

function xorNum($num1, $num2)
{
    $result = '';
    for ($i = 0; $i < strlen($num1); $i++)
    {
        if ($num1[$i] == $num2[$i])
            $result = $result . '0';
        else
            $result = $result . '1';
    }
    return $result;
}

function binarView4($num) {

    $length = iconv_strlen($num);
    if ($length == 1)
        $num = '000' . $num;
    if ($length == 2)
        $num = '00' . $num;
    if ($length == 3)
        $num = '0' . $num;
    return $num;
}

function binarView2($num) {

    $length = iconv_strlen($num);
    if ($length == 1)
        $num = '0' . $num;
    return $num;
}
function binarView3($num) {

    $length = iconv_strlen($num);
    if ($length == 1)
        $num = '00' . $num;
    if ($length == 2)
        $num = '0' . $num;
    return $num;
}

function s_Block($out_s1)
{
    $out_s1_binary = [];
    for ($i = 0; $i < 16; $i++)
    {
        $out_s1_binary[]  = binarView3(decbin($out_s1[$i]));
    }

    /** Вход 1  */

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

        /** Вероятность delta C*/

        $C = ['000', '001', '010', '011', '100', '101', '110', '111'];
        $keys = [];
        for ($i = 0; $i < 8; $i++) {
            $count = 0;
            for ($j = 0; $j < 16; $j++) {
                if ($delta_C[$j] == $C[$i])
                    $count++;
            }
            $keys[$C[$i]] = $count;
        }
        $result[$in_s1[$d]] = $keys;
    }

    return $result;
}

function s_Block3($out_s1)
{
    $out_s1_binary = [];
    for ($i = 0; $i < 16; $i++)
    {
        $out_s1_binary[]  = binarView2(decbin($out_s1[$i]));
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

        /** Вероятность delta C*/

        $C = ['00', '01', '10', '11'];
        $keys = [];
        for ($i = 0; $i < 4; $i++) {
            $count = 0;
            for ($j = 0; $j < 16; $j++) {
                if ($delta_C[$j] == $C[$i])
                    $count++;
            }
            $keys[$C[$i]] = $count;
        }
        $result[$in_s1[$d]] = $keys;
    }

    return $result;
}


function permutation($P)
{
    $res = [];
    for ($i = 0; $i < count($P); $i++)
    {
        for ($j = 0; $j < count($P); $j++)
        {
            if ($P[$i] == $P[$j] && $j != $i)
            {
                $res[] = $i;
                $res[] = $j;
            }

        }
    }
    return $res;
}

function deltaA($arr){
    $max = 0;
    $max_arr = [];
    foreach ($arr as $key => $item) {
        if ($key == '0000') {
            continue;
        }
        else
        {
            foreach ($item as $k => $value)
            {
                if ($value > $max)
                {
                    $max = $value;
                }
            }
        }
    }
    foreach ($arr as $key => $item) {
        if ($key == '0000') {
            continue;
        }
        else
        {
            foreach ($item as $k => $value)
            {
                if ($value == $max)
                {
                    $max_arr[$k] = $key;
                }
            }
        }
    }

    return $max_arr;
}

function s_Block_delta_C($out_s1, $delta)
{
    $out_s1_binary = [];
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


        /** Вход 2*/

        $in2_s1 = [];
        for ($i = 0; $i < 16; $i++) {
            $in2_s1[] = xorNum($in_s1[$i], $delta_A[$delta]);
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


    return $delta_C;
}


function s_Block_delta_C_S3($out_s1, $delta)
{
    $out_s1_binary = [];
    for ($i = 0; $i < 16; $i++)
    {
        $out_s1_binary[]  = binarView2(decbin($out_s1[$i]));
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


    /** Вход 2*/

    $in2_s1 = [];
    for ($i = 0; $i < 16; $i++) {
        $in2_s1[] = xorNum($in_s1[$i], $delta_A[$delta]);
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


    return $delta_C;
}



function permitation($num, $p)
{
    $result = '';
    for ($i = 0; $i < strlen($p); $i++)
    {
        $result = $result . $num[$p[$i] - 1];
    }
    return $result;
}

function read_savetxt_xr()
{
    $lines = file(__DIR__ . '/save.txt');

    $mas_xr = [];

    for ($i = 0; $i < count($lines); $i = $i + 4)
    {
        $mas_xr[] = substr($lines[$i], 13, 8);
    }
    return $mas_xr;
}
function read_savetxt_yr()
{
    $lines = file(__DIR__ . '/save.txt');

    $mas_yr = [];

    for ($i = 0; $i < count($lines); $i = $i + 4)
    {
        $mas_yr[] = substr($lines[$i], 39, 8);
    }

    return $mas_yr;
}
function read_savetxt_yl()
{
    $lines = file(__DIR__ . '/save.txt');

    $mas_yr = [];

    for ($i = 2; $i < count($lines); $i = $i + 4)
    {
        $mas_yr[] = revers_perm(substr($lines[$i], 26, 8));
    }

    return $mas_yr;
}

function revers_perm($str)
{
    $res = [];
    $res_str = '';
    $copy = $str;
    $p = '87325416';
    for ($i = 0; $i < strlen($p); $i++)
    {
        $res[$p[$i]] = $str[$i];
    }
    ksort($res);
    $res_str = implode($res);

    return $res_str;
}


