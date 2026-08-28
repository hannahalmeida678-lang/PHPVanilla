<?php

$valorCompra = 300.00;

$statusFrete = ($valorCompra >= 250.00) ? "Frete Grátis" : "Frete R$ 25,00";

echo $statusFrete;

?>