<?php
require_once __DIR__ . '/functions.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="item">
        <h2>S1</h2>
        <table>
            <tr>
                <td>4</td>
                <td>6</td>
                <td>6</td>
                <td>3</td>
                <td>1</td>
                <td>3</td>
                <td>7</td>
                <td>4</td>
            </tr>
            <tr>
                <td>5</td>
                <td>1</td>
                <td>5</td>
                <td>7</td>
                <td>2</td>
                <td>0</td>
                <td>0</td>
                <td>2</td>
            </tr>
        </table>
    </div>
    <div class="item">
        <h2>S2</h2>
        <table>
            <tr>
                <td>6</td>
                <td>3</td>
                <td>6</td>
                <td>0</td>
                <td>4</td>
                <td>1</td>
                <td>7</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3</td>
                <td>5</td>
                <td>1</td>
                <td>7</td>
                <td>2</td>
                <td>4</td>
                <td>0</td>
                <td>5</td>
            </tr>
        </table>
    </div>
    <div class="item">
        <h2>S3</h2>
        <table>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>2</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>2</td>
                <td>2</td>
            </tr>
            <tr>
                <td>2</td>
                <td>0</td>
                <td>3</td>
                <td>3</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>3</td>
                <td>3</td>
            </tr>
        </table>
    </div>
    <div class="item">
        <h2>P/E</h2>
        <table>
            <tr>
                <td>4</td>
                <td>6</td>
                <td>3</td>
                <td>2</td>
                <td>1</td>
                <td>5</td>
                <td>8</td>
                <td>7</td>
                <td>4</td>
                <td>1</td>
                <td>6</td>
                <td>3</td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>

<?php

/** Выход 1 */

$out_s1 = [4, 6, 6, 3, 1, 3, 7, 4, 5, 1, 5, 7, 2, 0, 0, 2]; // Выход блока S1
$out_s1_gmp = [];
for ($i = 0; $i < 16; $i++)
{
    $out_s1_gmp[]  = gmp_init($out_s1[$i], 10);
}

$result_arr = [];

//var_dump($out_s1_gmp);

/** Вход 1 */
$in_s = [];
for ($i = 0; $i < 16; $i++)
{
    $in_s[] = gmp_init($i, 10);
}

//var_dump($in_s);


for ($d = 0; $d < 16; $d++) {

    echo '<h1>' . outDisplayNum($in_s[$d]) .  '</h1>';
    /** Вход 2*/
    $arr_test = [];

    for ($i = 0; $i < 16; $i++) {
        $arr_test[] = gmp_xor($in_s[$i], $in_s[$d]);
    }

    /** Выход 2 */

    $out2_s1 = [];

    for ($i = 0; $i < 16; $i++) {
        $key = array_search($arr_test[$i], $in_s);
        $out2_s1[] = $out_s1[$key];
    }

    /** delta C1 */

    $delta_C = [];

    for ($i = 0; $i < 16; $i++) {
        $delta_C[] = gmp_xor($out_s1_gmp[$i], $out2_s1[$i]);
    }


    $test_array = array_count_values(outDisplayOut($delta_C));

    $result_count = [];

    foreach ($test_array as $key => $count)
    {
        $key = strval($key);
        $result_count[$key] = $count;
    }




    var_dump(outDisplayOut($delta_C));
    var_dump($test_array);
    var_dump($result_count);
    $result_arr[outDisplayNum($d)] = array_count_values(outDisplayOut($delta_C));



}
?>

    <table>
        <thead>
        <tr>
            <td>delta C/A</td>
            <?php for ($i = 0; $i < 8; $i++):?>
                <td><?php echo outDisplayNum3($i)?></td>
            <?php endfor;?>
        </tr>
<!--        --><?php //for ($i = 0; $i < 16; $i++):?>

        <tr>

        </tr>
        </thead>
    </table>

<?php

    var_dump($result_arr);
    var_dump($out_s1_gmp);
    //for ($)
die();



/*
$out_s1 = [6, 0, 7, 6, 0, 4, 1, 1, 4, 5, 5, 3, 2, 2, 7, 3]; // Выход блока S1
$out_s2 = [4, 0, 1, 4, 0, 7, 3, 5, 3, 5, 7, 6, 2, 1, 6, 2]; // Выход блока S2
$out_s3 = [2, 0, 0, 2, 3, 2, 2, 1, 0, 1, 0, 3, 1, 3, 3, 1]; // Выход блока S3
$PE = [6, 7, 4, 1, 3, 2, 5, 8, 6, 4, 7, 1];

 */







