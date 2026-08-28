<?php

function formatarNome(string $nome): string{
     $nome = trim($nome);
    $nome = strtolower($nome);
    $nome = ucfirst($nome);

    return $nome;
}

echo formatarNome(" JOÃO ");
echo " ";
echo formatarNome("mARIA");
echo " ";
echo formatarNome("   PEDRO   ");



?>