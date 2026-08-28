<?php
function senhaforte(string $senha): bool{
    return strlen($senha) > 8;
}

$senha = "123456789";

if (senhaforte($senha)) {
    echo "senha forte!";
} else{
     "senha fraca";
}



?>