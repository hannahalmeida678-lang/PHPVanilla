<?php

function aplicarDesconto(float &$preco, float $porcentagem): void
{
    $desconto = $preco * ($porcentagem / 100);
    $preco = $preco - $desconto;
}

$preco = 200.00;

echo "Preço antes: R$ " . $preco . "\n";

aplicarDesconto($preco, 15);

echo "Preço depois: R$ " . $preco;

?>