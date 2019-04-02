<?php
$lines = file(__DIR__ . '/save.txt');

$mas_xr = [];
$mas_yr = [];

for ($i = 0; $i < count($lines); $i = $i + 4)
{
    $mas_xr[] = substr($lines[$i], 13, 8);
    $mas_yr[] = substr($lines[$i], 39, 8);
}
var_dump($mas_xr);
var_dump($mas_yr);