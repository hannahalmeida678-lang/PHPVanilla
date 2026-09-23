
<?php

$arquivo = 'chat.json';
$mensagem = '';
$erro = '';
$mensagens = [];


function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}


if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $mensagens = json_decode($conteudo, true) ?? [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mensagem = trim($_POST['mensagem'] ?? '');

    
    if ($mensagem === '') {

        $erro = 'A mensagem não pode estar vazia.';

    
    } elseif (mb_strlen($mensagem, 'UTF-8') > 250) {

        $erro = 'A mensagem não pode ultrapassar 250 caracteres.';

    } else {

      
        $mensagens[] = [
            'mensagem' => $mensagem,
            'data' => date('d/m/Y H:i:s')
        ];

       
        file_put_contents(
            $arquivo,
            json_encode(
                $mensagens,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        $mensagem = '';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chat Industrial</title>

    
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Chat da Operação</h1>

    <p class="subtitulo">
        Comunicação entre operador de máquina e supervisor.
    </p>


    <?php if ($erro !== ''): ?>

        <div class="erro">
            <?= e($erro) ?>
        </div>

    <?php endif; ?>


   

    <form method="POST">

        <label for="mensagem">
            Mensagem:
        </label>

        <textarea
            id="mensagem"
            name="mensagem"
            maxlength="250"
            placeholder="Digite sua mensagem..."
        ><?= e($mensagem) ?></textarea>

        <button type="submit">
            Enviar mensagem
        </button>

    </form>


  

    <div class="chat">

        <h2>Mensagens</h2>


        <?php if (empty($mensagens)): ?>

            <p class="vazio">
                Nenhuma mensagem enviada ainda.
            </p>

        <?php else: ?>


            <?php foreach ($mensagens as $item): ?>

                <div class="mensagem">

                    <span class="data">
                        <?= e($item['data']) ?>
                    </span>

                    <p class="texto">

                        <?php
                        
                    

                        echo nl2br(e($item['mensagem']));
                        ?>

                    </p>

                </div>

            <?php endforeach; ?>


        <?php endif; ?>

    </div>

</div>

</body>

</html>
