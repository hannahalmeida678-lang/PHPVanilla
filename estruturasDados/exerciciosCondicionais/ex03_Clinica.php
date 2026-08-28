<?php
declare(strict_types=1);
//Crie as variáveis $peso (ex: 85.5) e $altura (ex: 1.75).
$peso = 54;
$altura = 1.59;

$IMC = $peso/($altura**2);

if ($IMC < 18.5 ){
    echo "Abaixo do peso";
}
elseif($IMC >= 18.5) {
echo "peso normal";
}
elseif($IMC > 30) {
echo "Obesidade Grau I";
}
elseif($IMC > 35) {
echo "Obesidade Grau II ou III";
}
?>

resoluçao
<?php
declare(strict_types=1);
$peso = 95;
$altura = 1.75;

$imc = $peso/($altura**2);
if($imc < 18.5){
    echo "Abaixo do Peso";
    } elseif($imc < 25){
        echo "Peso Normal";
        } elseif($imc < 30){
            echo "Sobrepeso";
            } elseif($imc < 35) {
                echo "Obesidade Grau I";
            } else{
                echo "Obesidade Grau II ou III";
}
?>