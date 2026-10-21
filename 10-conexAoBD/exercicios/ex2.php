<?php
declare(strict_types=1);

require_once __DIR__ . '/ConexaoBanco.php';

define('ARQUIVO_CONFIG', __DIR__. 'database.ini');
echo "teste de identidade do singleton";

$conexao1 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
$conexao2 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

$id1 = spl_object_id($conexao1);
$id2 = spl_object_id($conexao2);

// Exibe os identificadores.
echo "ID da conexão 1: $id1\n";
echo "ID da conexão 2: $id2\n";
if($conexao1 === $conexao2){
    echo "as duas variaveis tem o emsmo objeto";
}else{
    echo "erro: a conexão tem objetos diferentes";
}