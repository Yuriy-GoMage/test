<?php
function getPrimes($n)
{
    $primes = [];
    $isComposite = [];
    for ($i = 4; $i <= $n; $i += 2) {
        $isComposite[$i] = true;       
    }
    $next_prime = 3;
    while ($next_prime <= (int)sqrt($n)) {
        for ($i=$next_prime*2; $i<=$n; $i+=$next_prime) {
            $isComposite[$i] = true;       
        }
        $next_prime += 2;
        while ($next_prime <= $n && isset($isComposite[$next_prime])) {
            $next_prime+=2; 
        }
    }
    for ($i=2; $i<=$n; $i++) {
        if (!isset($isComposite[$i])) {
            $primes[] = $i;
        }
    }
    return $primes;
}

function sumPrimes($n)
{
    $primeArray = getPrimes($n);
    $primeSum = $maxCount = 0;
    $primeSumArray = [];

    do {
        $a = [];
        foreach ($primeArray as $k => $prime) {
            $a[] = $prime;
            $primeSum = array_sum($a);
            if (in_array($primeSum, $primeArray) && $primeSum < $n && count($a) >= $maxCount) {
                $primeSumArray = [
                    'prime' => $primeSum,
                    'number_of_elements' => count($a),
                    'elements' => implode(', ', $a),
                ];
                $maxCount = count($a);
            } elseif ($primeSum >= $n) {
                break;
            }
        }
        array_shift($primeArray);
    } while (!empty($primeArray));

    return $primeSumArray;
}
$n = 1000000;
$array = sumPrimes($n);
print_r($array);
?>