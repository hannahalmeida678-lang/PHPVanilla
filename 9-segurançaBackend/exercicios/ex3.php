<?php

function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

$busca = $_GET['q'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
    <style>
        /* Configurações gerais */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    color: #333;
    margin: 0;
    padding: 20px;
}

/* Título */
h1 {
    text-align: center;
    color: #333;
}

/* Container principal */
.container {
    max-width: 800px;
    margin: 30px auto;
    background-color: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Inputs */
input,
textarea,
select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Botão */
button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Links */
a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
}
    </style>
</head>
<body>

    <h1>Busca de Produtos</h1>

    <form method="GET">
        <input
            type="text"
            name="q"
            value="<?= e($busca) ?>"
        >

        <button type="submit">Buscar</button>
    </form>

    <p>Você buscou por: <?= e($busca) ?></p>

</body>
</html>