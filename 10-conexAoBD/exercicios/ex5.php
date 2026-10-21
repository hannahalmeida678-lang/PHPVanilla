
<?php

require_once __DIR__ . '/ConexaoBanco.php';

define('ARQUIVO_CONFIG', __DIR__ . '/database.ini');

const TOTAL_TESTES = 50;

/**
 * Escapa valores antes de exibi-los no HTML.
 */
function h(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Carrega as configurações do banco.
 * Aceita a seção [database] usada nos exercícios anteriores.
 */
function carregarConfiguracaoBenchmark(): array
{
    $arquivo = parse_ini_file(ARQUIVO_CONFIG, true);

    if ($arquivo === false) {
        throw new RuntimeException('Não foi possível ler database.ini.');
    }

    if (isset($arquivo['database'])) {
        $db = $arquivo['database'];

        return [
            'host' => $db['host'] ?? 'localhost',
            'port' => $db['port'] ?? 5432,
            'dbname' => $db['dbname'] ?? '',
            'user' => $db['user'] ?? '',
            'password' => $db['password'] ?? ''
        ];
    }

    throw new RuntimeException(
        'A seção [database] não foi encontrada no database.ini.'
    );
}

/**
 * Mede o tempo e a variação de memória de uma operação.
 */
function medir(callable $operacao): array
{
    if (function_exists('memory_reset_peak_usage')) {
        memory_reset_peak_usage();
    }

    $memoriaInicial = memory_get_usage(false);
    $inicio = hrtime(true);

    $operacao();

    $tempoMs = (hrtime(true) - $inicio) / 1_000_000;
    $memoriaFinal = memory_get_usage(false);
    $pico = memory_get_peak_usage(false);

    return [
        'tempo_ms' => $tempoMs,
        'memoria_delta_kb' => ($memoriaFinal - $memoriaInicial) / 1024,
        'pico_kb' => $pico / 1024
    ];
}

try {
    $config = carregarConfiguracaoBenchmark();

    if ($config['dbname'] === '' || $config['user'] === '') {
        throw new RuntimeException(
            'Informe dbname e user no database.ini.'
        );
    }

    $dsn = sprintf(
        'pgsql:host=%s;port=%s;dbname=%s',
        $config['host'],
        $config['port'],
        $config['dbname']
    );

    // Verifica se o banco está acessível antes de iniciar o benchmark.
    $teste = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $teste = null;

    // Teste 1: cria uma conexão PDO nova em cada iteração.
    $semSingleton = medir(function () use ($dsn, $config): void {
        for ($i = 0; $i < TOTAL_TESTES; $i++) {
            $pdo = new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $pdo->query('SELECT 1')->fetchColumn();

            // Libera a conexão antes da próxima iteração.
            $pdo = null;
        }
    });

    // Teste 2: reutiliza a conexão fornecida pelo Singleton.
    $comSingleton = medir(function (): void {
        for ($i = 0; $i < TOTAL_TESTES; $i++) {
            $pdo = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
            $pdo->query('SELECT 1')->fetchColumn();
        }
    });

    $economiaTempo = $semSingleton['tempo_ms'] > 0
        ? (1 - $comSingleton['tempo_ms'] / $semSingleton['tempo_ms']) * 100
        : 0;

} catch (Throwable $e) {
    http_response_code(500);
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Erro no benchmark</title>
    </head>
    <body>
        <h1>Não foi possível executar o benchmark</h1>
        <p><?= h($e->getMessage()) ?></p>
    </body>
    </html>
    <?php
    exit;
}

?>

