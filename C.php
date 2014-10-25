
<?php

function fibonacciRecursive($n1=1, $n2=1, $max=10, &$numbers=[]){
    $numbers[] = $n1;
    if($max==(count($numbers)+1)){
        $numbers[] = $n2;
        return $n2;
    }
    fibonacciRecursive($n2, $n1+$n2, $max, $numbers);
    return $numbers;
}
function fibonacciNotRecursive($n1=1, $n2=1, $max=10){
    $numbers = [$n1, $n2];
    for($i=2; $i<$max; $i++){
        $numbers[] = $numbers[$i-2] + $numbers[$i-1];
    }
    return $numbers;
}

echo implode(',',fibonacciRecursive());
echo "\n";
echo implode(',',fibonacciNotRecursive());