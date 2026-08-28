<?php

function calcularMedia(array $notas): float
{
    $soma = 0;

    foreach ($notas as $nota) {
        $soma += $nota;
    }

    return $soma / count($notas);
}

function verificarAprovacao(float $media): string
{
    if ($media >= 7) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

$notas = [8, 7, 9, 6];

$media = calcularMedia($notas);

echo "Média: " . $media . "\n";
echo "Situação: " . verificarAprovacao($media) . "\n";
echo "Maior nota: " . max($notas) . "\n";
echo "Menor nota: " . min($notas);

?>