<?php
declare(strict_types=1);

define('ARQUIVO_CONFIG', __DIR__. 'database.ini');

function carregarAmbiente(string $ambiente): array{
     if (!file_exists(ARQUIVO_CONFIG)) {
        throw new RuntimeException(
            "Arquivo database.ini não encontrado."
        );
    }

}
$config = parse_ini_file(ARQUIVO_CONFIG, true);
if ($config === false) {
        throw new RuntimeException(
            "Não foi possível ler o arquivo INI."
        );
    }

    if (!isset($configuracoes[$ambiente])) {
        throw new InvalidArgumentException(
            "Ambiente '$ambiente' não encontrado."
        );
    }

    return $configuracoes[$ambiente];


/**
 * Cria uma conexão com o banco do ambiente escolhido.
 */
function conectarAmbiente(string $ambiente): PDO
{
    $config = carregarAmbiente($ambiente);

    $host = $config['db_host'];
    $porta = $config['db_port'];
    $banco = $config['db_name'];
    $usuario = $config['db_user'] ?? 'postgres';
    $senha = $config['db_password'] ?? '';

    $dsn = "pgsql:host=$host;port=$porta;dbname=$banco";

    return new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);
}

// Escolha do ambiente: development ou testing.
