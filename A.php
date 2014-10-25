#!/usr/bin/php -q

<?php
function sumMod($mods, $max=1000){
    $res = 0;
    for($i=0; $i<$max; $i++){
        for($j=0; $j<count($mods); $j++){
            if(($i%$mods[$j])===0){
                $res += $i;
                break;
            }
        }
    }
    return $res;
}

function sum3_5_1000(){
    echo sumMod([3, 5], 1000);
}

function sum3_4_1000(){
    echo sumMod([3, 4], 1000);
}


echo sum3_5_1000();
echo "\n";
echo sum3_4_1000();