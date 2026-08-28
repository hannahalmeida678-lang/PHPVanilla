<?php
    declare(strict_types=1);
// Crie uma variável $idade.
$idade = 16;
// Se a idade for menor que 16, exiba: "Voto Proibido".
if ($idade < 16) {
echo "voto proibido";
//Se a idade for entre 16 e 17, ou maior/igual a 70, exiba: "Voto Facultativo".

} elseif ($idade == 16) {
    echo "Voto Facultativo";

}
 // Se a idade for entre 18 e 69, exiba: "Voto Obrigatório".
elseif ($idade >= 18) {
    echo "voto obrigatorio";
}
?>