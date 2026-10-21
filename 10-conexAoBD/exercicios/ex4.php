
<?php

define('ARQUIVO_CONFIG', __DIR__ . '/database.ini');
define('ARQUIVO_LOG', __DIR__ . '/logs/sistema.log');


 //Registra mensagens no arquivo de log.
 
function registrarLog(string $nivel, string $mensagem): void
{
    $niveisPermitidos = ['INFO', 'WARNING', 'ERROR'];
    if (!in_array($nivel, $niveisPermitidos, true)) {
        throw new InvalidArgumentException(
            "Nível de log inválido: $nivel"
        );
    }

    $diretorio = dirname(ARQUIVO_LOG);

    if (!is_dir($diretorio)) {
        if (!mkdir($diretorio, 0750, true) && !is_dir($diretorio)) {
            throw new RuntimeException(
                "Não foi possível criar a pasta de logs."
            );
        }
    }
}

$dataHora = date("y-m-d H:i:s");
$linah = "[$dataHora] [$nivel] $mensagem" . PHP_EOL;
 if ($gravado === false) {
        throw new RuntimeException(
            "Não foi possível gravar o arquivo de log."
        );
    }
}

function testarConexao(): void
{
    try {
        if (!file_exists(ARQUIVO_CONFIG)) {
            throw new RuntimeException(
                "Arquivo database.ini não encontrado."
            );
        }

        $config = parse_ini_file(ARQUIVO_CONFIG, true);

        if (
            $config === false ||
            !isset($config['database']['host'],
                   $config['database']['port'],
                   $config['database']['dbname'],
                   $config['database']['user'])
        ) {
            throw new RuntimeException(
                "Configuração do banco incompleta ou inválida."
            );
        }

        $db = $config['database'];

        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            $db['host'],
            $db['port'],
            $db['dbname']
        );

        $pdo = new PDO(
            $dsn,
            $db['user'],
            $db['password'] ?? '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 5
            ]
        );

        // Confirma que a conexão responde.
        $pdo->query('SELECT 1');

        registrarLog(
            'INFO',
            'Conexão com PostgreSQL estabelecida com sucesso.'
        );

        echo "SUCESSO: conexão estabelecida e registrada no log.\n";

    } catch (PDOException $e) {
        registrarLog(
            'ERROR',
            'Falha na conexão PDO: ' . $e->getMessage()
        );

        fwrite(STDERR, "ERRO: falha na conexão. Consulte o log.\n");
        exit(1);

    } catch (RuntimeException $e) {
        registrarLog('ERROR', $e->getMessage());

        fwrite(STDERR, "ERRO: {$e->getMessage()}\n");
        exit(1);
    }
}

try {
    testarConexao();
} catch (Throwable $e) {
    // Captura também falhas inesperadas no próprio registro do log.
    fwrite(STDERR, "ERRO CRÍTICO: {$e->getMessage()}\n");
    exit(1);
}