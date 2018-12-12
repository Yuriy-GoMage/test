<?php
define("max_value", 1000000);
define("limit", floor(sqrt(max_value)));

$simples = str_repeat("X", max_value + 1);

for ($i = 2; $i<=limit; $i++) {
    if ($simples[$i] === "X") {
        for ($j = $i * $i; $j <= max_value; $j+=$i) {
            $simples[$j] = "Y";
        }
    }
}

$terms = 1;
$simples = array_keys(str_split($simples), 'X');
$sums=[];

foreach ($simples as $index => $simple) {
    if($index == 0 || $index == 1) {continue;}
    $sum = 0;

    if(empty($sums)){
        $sums[$terms] = $simple;
    } else{
        $sums[$terms] = $sums[$terms - 1] + $simple;
    }

    if($sums[$terms] >= max_value) {
        break;
    }
    $terms++;
}

foreach(array_reverse($sums, true) as $terms => $result) {
    if(is_simple($result)){
        var_dump($result);
        var_dump($terms);
        break;
    }
}

function is_simple($var) {
    if($var == 2) {
        return true;
    }

    if($var%2 == 0) {
        return false;
    }
    $i = 3;

    while ($i <= floor(sqrt($var))){
        if ($var%$i == 0)
            return false;
        $i+=2;
    }
    return true;
}
