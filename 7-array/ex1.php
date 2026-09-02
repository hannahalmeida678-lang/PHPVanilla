<?php

$notas = [10, 9, 7, 5];

$soma = 0;

foreach ($notas as $nota ){
    $soma= $soma += $nota;
}
$media = $soma /count($notas);

echo "a media final é $media";

if ($media >= 7) {

    echo " aprovado";

}
else{
   echo "reprovado";
   }
   ?>
