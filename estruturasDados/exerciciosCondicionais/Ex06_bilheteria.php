RESOLUSÂO

<?php 
declare(strict_types=1);
?>

<?php 
$ingressoBase = 40.00;
$diaSemana = "Quarta";


$ingressoBase = match($diaSemana) {
    "Segunda", "Terça" => $ingressoBase*0.8,
    "Quarta" => $ingressoBase*0.5,
    "Quinta", "Sexta", "Sábado", "Domingo" => $ingressoBase
};

$descontoDia = $ingressoBase;

$isEstudante = true;
if($isEstudante === true) {
    $descontoDia = $descontoDia*0.5;
} 

$valorFinal = $descontoDia;

echo "O valor final do ingresso ficou em R$ $valorFinal";

?>