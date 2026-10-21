<?php
declare(strict_types=1);

$arquivo = __DIR__. "database.ini";

if(!file_exists($arquivo)){
    echo "arquivo não encontrado";
}

$config = parse_ini_file($arquivo, true);

if ($config === false || !isset($config['database'])) {
    echo "nao foi possivel configurar o banco";
    exit();
}

$db = $config['database'];

$host = $db['host'] ?? 'localhost';
$port = (int) ($db['port'] ?? 5432);
$nomeBanco = $db['dbname'] ?? '127.0.0.1';
$usuario = $db['user'] ?? 'postgres';
$senha = $db['password'] ?? 'postgres';

if ($nomeBanco === '' || $usuario === '') {
    echo "ERRO: nome do banco ou usuário não informado.\n";
    exit();
}

echo "=== Diagnóstico PostgreSQL ===\n";
echo "Host: $host\n";
echo "Porta: $port\n";

try {
     $dsn = "pgsql:host=$host;port=$port;dbname=$nomeBanco";

    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);
     $resultado = $pdo->query('SELECT version()');
    $versao = $resultado->fetchColumn();

    echo "SUCESSO: conexão com o banco estabelecida!\n";
} catch (PDOExeption $e){
    echo "não foi possivel conectar ao banco";
}

