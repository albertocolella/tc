#!/usr/bin/php -q

<?php
if(!defined("STDIN")) {
    define("STDIN", fopen('php://stdin','r'));
}

function powSum($num, $exp){
    $num = intval($num);
    $exp = intval($exp);
    if($exp===0){
        return 1;
    }
    $res = $num;
    for($i=0; $i<$exp-1; $i++){
        $tmp = 0;
        for($j=0; $j<$num-1; $j++){
            $tmp += $res;
        }
        $res += $tmp;
    }
    return $res;
}

echo "Please write the number:";
$num = fread(STDIN, 80);
if(empty($num) || !is_int(intval($num))){
    die("Number is not a value.");
}
$num = str_replace(array("\n", "\r"), '', $num);
echo "Please write the power:";
$pow = fread(STDIN, 80);
if(empty($pow) || !is_int(intval($pow))){
    die("Power is not a value.");
}
$pow = str_replace(array("\n", "\r"), '', $pow);
echo $num . "^" . $pow . "=" . powSum($num, $pow);
