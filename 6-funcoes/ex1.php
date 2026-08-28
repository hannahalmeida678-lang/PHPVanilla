<?php

declare(strict_types=1);

function calcularImc( float $peso, float $altura){
    return $peso / ($altura * $altura);
}

$peso1 = 70;
$altura1 = 1.75;
$imc1 = calcularImc($peso1, $altura1);

echo "IMC equivale a: " . number_format($imc1, 2, ',', '.');


// Teste 2
$peso2 = 60;
$altura2 = 1.65;
$imc2 = calcularIMC($peso2, $altura2);

echo "IMC 2: " . number_format($imc2, 2, ',', '.');

// Teste 3
$peso3 = 90;
$altura3 = 1.80;
$imc3 = calcularIMC($peso3, $altura3);

echo "IMC 3: " . number_format($imc3, 2, ',', '.');


?>