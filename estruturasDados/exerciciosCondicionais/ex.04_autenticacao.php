<?php
declare(strict_types=1);
//crie as variáveis $cargoUsuario (string) e $senhaDigitada (string).
$cargoUsuario = "Diretor";
$senhaDigitada =  "SenhaSegura123";   

// Crie uma variável com a senha correta do sistema: $senhaSistema = "SenhaSegura123";.
 $SenhaSistema = "SenhaSegura123";

 if ($senhaDigitada === $SenhaSistema && $cargoUsuario === "Diretor" || $cargoUsuario === "Gerente") {

 echo "acesso liberado";

 } else {
    echo "acesso negado";
 }


?>