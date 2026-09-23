
<?php
declare(strict_types=1);
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}

$arquivo = "recados.json";
$nome = "";
$mensagem = "";

// Cria o arquivo se ele não existir
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "[]");
}

// Lê os recados
$recados = json_decode(file_get_contents($arquivo), true);

if (!is_array($recados)) {
    $recados = [];
}

// Quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");

    if (strlen($nome) < 3) {

        echo "O nome deve ter pelo menos 3 caracteres.";

    } elseif (strlen($mensagem) < 5) {

        echo "A mensagem deve ter pelo menos 5 caracteres.";

    } else {

        // Adiciona o recado
        $recados[] = [
            "nome" => $nome,
            "mensagem" => $mensagem
        ];

        // Salva no arquivo
        file_put_contents(
            $arquivo,
            json_encode(
                $recados,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        echo "Mensagem enviada com sucesso!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mural de Recados</title>

    <style>

        /* ===== CONFIGURAÇÕES GERAIS ===== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #eef2f7;
            color: #333;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* ===== CONTAINER ===== */

        .container {
            max-width: 700px;
            margin: auto;
        }

        /* ===== TÍTULO ===== */

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 38px;
            margin-bottom: 30px;
        }

        /* ===== FORMULÁRIO ===== */

        form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
            margin-bottom: 40px;
        }

        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #34495e;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.25);
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        /* ===== BOTÃO ===== */

        button {
            width: 100%;
            padding: 14px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2980b9;
        }

        /* ===== TÍTULO DOS RECADOS ===== */

        h2 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* ===== RECADOS ===== */

        .recado {
            background: white;
            margin-bottom: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .recado-nome {
            background: #3498db;
            color: white;
            padding: 15px 18px;
            font-size: 18px;
        }

        .recado-mensagem {
            padding: 18px;
            line-height: 1.6;
            font-size: 16px;
        }

        /* ===== MENSAGEM DE SUCESSO/ERRO ===== */

        .mensagem-sistema {
            max-width: 700px;
            margin: 0 auto 20px;
            padding: 12px 15px;
            background: #ffffff;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        /* ===== CELULAR ===== */

        @media (max-width: 600px) {

            body {
                padding: 25px 15px;
            }

            h1 {
                font-size: 30px;
            }

            form {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }
        }

    </style>

</head>

<body>

<div class="container">

    <h1>📋 Mural de Recados</h1>

    <form method="POST">

        <div class="campo">

            <label for="nome">Nome:</label>

            <input
                type="text"
                id="nome"
                name="nome"
                required
                minlength="3"
                value="<?= e($nome) ?>"
            >

        </div>

        <div class="campo">

            <label for="mensagem">Mensagem:</label>

            <textarea
                id="mensagem"
                name="mensagem"
                required
                minlength="5"
            ><?= e($mensagem) ?></textarea>

        </div>

        <button type="submit">
            Enviar Recado
        </button>

    </form>

    <h2>💬 Recados</h2>

    <?php foreach ($recados as $recado): ?>

        <div class="recado">

            <div class="recado-nome">

                <strong>
                    <?= e($recado["nome"]) ?>
                </strong>

            </div>

            <div class="recado-mensagem">

                <?= nl2br(e($recado["mensagem"])) ?>

            </div>

        </div>

    <?php endforeach; ?>

</div>

</body>

</html>

