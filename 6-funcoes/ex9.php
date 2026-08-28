<?php

function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if ($cliente["nome"] == $nome) {
            return $cliente;
        }
    }

    return null;
}

$clientes = [
    ["nome" => "Maria", "email" => "maria@email.com"],
    ["nome" => "João", "email" => "joao@email.com"],
    ["nome" => "Pedro", "email" => "pedro@email.com"]
];

// Cliente encontrado
$resultado = buscarCliente($clientes, "Maria");

if ($resultado != null) {
    echo "Cliente encontrado: " . $resultado["nome"] . "\n";
    echo "E-mail: " . $resultado["email"] . "\n";
} else {
    echo "Cliente não encontrado.\n";
}

// Cliente não encontrado
$resultado = buscarCliente($clientes, "Carlos");

if ($resultado != null) {
    echo "Cliente encontrado: " . $resultado["nome"] . "\n";
    echo "E-mail: " . $resultado["email"] . "\n";
} else {
    echo "Cliente não encontrado.";
}

?>