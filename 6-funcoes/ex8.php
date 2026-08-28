<?php

function limparCPF(string $cpf): string
{
    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);

    return $cpf;
}

function cpfValido(string $cpf): bool
{
    $cpf = limparCPF($cpf);

    if (strlen($cpf) == 11 && is_numeric($cpf)) {
        return true;
    } else {
        return false;
    }
}

$cpf = "123.456.789-00";

if (cpfValido($cpf)) {
    echo "CPF válido!";
} else {
    echo "CPF inválido!";
}

?>