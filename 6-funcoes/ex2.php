<?php 

declare(strict_types=1);

function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc <= 24.9) {
        return "Peso normal";
    } elseif ($imc <= 29.9) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

// Testes
$imc1 = 17.5;
$imc2 = 22.5;
$imc3 = 27.5;
$imc4 = 32.0;

echo "IMC 1: " . classificarIMC($imc1);
echo "IMC 2: " . classificarIMC($imc2);
echo "IMC 3: " . classificarIMC($imc3);
echo "IMC 4: " . classificarIMC($imc4);

?>


