<?php
//  1. blindagem de operações entre variáveis de tipos diferentes
declare(strict_types=1);

//criar um calculo de holerite em php

// declaraçao de constantes
 
const TAXA_INSS = 0.08; 
const DESCONTO_VT = 150.00

//DECLARAR VARIAVEIS
//Dados do Funcionário
;$nomeFuncionario = "jOÃO SILVA";
$salariobase = 3200.00;
$horasExtras = 10;

// declaraçao de variaveis usando camelcase
// regra -> primeira palavra toda minúsculo e depois as demais palavras usa-se maiusculas na primeira palavra
// exemplo $hojeEstáUmDiaBonito

//CALCULOS do salario
//Valor da extra (1.6 da hora normal
$valorHoraExtra = ($salariobase/220) * 1.6;
// crie uma variavel chamada $totaldehorasextras
$totalHoraExtra = $valorHoraExtra * $horasExtras;
// -> Crie uma variável $slarioBruto
$salarioBruto = $salariobase + $totalHoraExtra;
// -> Criar a variável $descontoInss
 $descontoInss = $salarioBruto * TAXA_INSS;
// -> Criar a variável $salarioLiquido
$salarioliquido = ($salarioBruto - $descontoInss) - DESCONTO_VT

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    < <title>Holerite <?php echo $nomeFuncionario ?> </title> 
    <!-- folha de estilização CSS -->
      <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Demostrativo de pagamento</h2>
<!-- Saida de Dados Misturando HTML e PHP em uma tabela -->
    <table>
        <tr>
            <th>Colaborador(a)</th>
            <td><?php echo $nomeFuncionario; ?> </td>
        </tr>
        <tr>
                <th>Salário Base</th>
             <td>R$ <?php echo number_format($salariobase, 2, ",", ".",) ?></td>
            <!-- forçar a saida de numeros usando uma função number_format -->
         </tr>
         
          <tr>
          <th>Valor Hora Extra </th>
          <td> <?php echo number_format($valorHoraExtra, 2, ",", "."); ?></td>
       </tr>
        <tr>
            <th>Hora Extra</th>
            <td> <?php echo number_format($horasExtras, 2, ",", "."); ?></td>
         </tr>
         <tr>
            <th>Salário Bruto </th>
            <td> <?php echo number_format($salarioBruto, 2, ",", "."); ?></td>
         </tr>
          <tr>
            <th>Desconto INSS </th>
            <td> <?php echo number_format($descontoInss, 2, ",", "."); ?></td>
         </tr>
          <tr>
            <th>Total Salário Liquido </th>
            <td> <?php echo number_format($salarioliquido, 2, ",", "."); ?></td>
         </tr>

    </table>
    
</body>
</html>