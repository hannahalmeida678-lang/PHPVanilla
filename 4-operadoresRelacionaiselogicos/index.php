<?php
declare(strict_types=1);

//Motor de Análise de Créditos

//regras do negocio
// regra da idade: o cliente precisa te 18 anos ou mais e menos de 70 anos 
//regra da parcela (renda): o valor da parcela do emprestimo Não pode  ser maior que 30% da renda mensal do cliente
// Regra VIP: Se o cliente tiver um "Score de Crédito" maior que 800, ele tem aprovação automatica. (as regras de idade e renda não importa)
//aprovação final: o credito é liberado se (regra1 e regra2 forem verdadeira) ou se (regra3 verdadeira).

//dados que vieram do aplicativo do celular do cliente
$idadecliente = 25;
$rendamensal = 4000.00;
$valorEmprestimo = 10000.00;
$numeroparcela = 24;
$scorecredito = 750;

//2. calculos aritimeticos
$taxaJuros = 0.02; //Juros de 2º ao mês
$valorJurosTotal = $valorEmprestimo * $taxaJuros * $numeroparcela; //juros simples
 $ValorTotalPagar = $valorEmprestimo + $valorJurosTotal;
$valorParcela = $ValorTotalPagar / $numeroparcela;

//3. O Cérebro da Operação: Avaliação das Regras do Negócio
//Regra 1: Maior Igual a 18 e Menor que 70
$idadeValida =($idadecliente >= 18) && ($idadecliente < 70);

//regra2 nao pode ser maior que 30% da renda (Renda *0.30)
$limiteRenda = $rendamensal * 0.30;
$rendaSuficiente = ($valorParcela) <= ($limiteRenda);

//Regra 3: ClienteVIP (Score > 800)
$ClienteVip = ($scorecredito > 800);

//Aprovação Final
$aprovado = (($idadeValida && $rendaSuficiente) || $ClienteVip);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Crédito</title>
</head>
<body>
    <h2>analise de credito</h2>
    <hr>
    <?php echo "<h4> Valor de ParcelaValor da Parcela: R$ " . number_format($valorParcela, 2, ",", ".") . "</h4>" ; ?>
     <h4>Idade Válida: <?php echo ($idadeValida ?  "sim" :  "não") ?></h4>  
     <h4>rCliente Vip <?php echo ($ClienteVip ?  "sim" :  "não") ?></h4> 
      <h4>Resultado Final: <?php echo ($aprovado ? "sim" : "não") ?></h4>
 
</body>
</html>