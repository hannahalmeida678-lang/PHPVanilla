<?php
declare(strict_types=1);
//função para codificar o escape contra o XSS
function e(string $texto):string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
}
$nome = trim($_GET["nome"] ?? "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Blindada contra XSS</title>
</head>
<body>
    <h1>Perfil do usuario</h1>

    <p>bem-vindo <?=  e($nome) ?>!</p>
    <form action="seguro.php" method="GET">
        <label for="">Digite seu Nome</label>
        <input type="text" name="nome" value="<?= e($nome) ?>">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>