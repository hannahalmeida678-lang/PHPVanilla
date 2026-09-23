<?php 
function e(string $valor): string{
    return htmlspecialchars($valor, ENT_QUOTES, "UTF-8");
}

function sanitizarTexto(string $dado): string{
    return trim(strip_tags($dado));
}

function validarColaborador(array $dados): array{
    $erros = [];

    if (empty($dados["nome"])){
        $erros["nome"] = "o nome é obrigatório";
    }

     if (
        empty($dados['email']) ||
        filter_var($dados['email'], FILTER_VALIDATE_EMAIL) === false
    ) {
        $erros['email'] = 'Informe um e-mail válido.';
    }
    if (
        $dados["matricula"] === '' || filter_var($dados["matricula"], FILTER_VALIDATE_INT) === false
    ){
        $erros["matricula"] = "a matricula deve ser um numero inteiro válido.";
    }
    if(
        $dados["salario"] === "" || filter_var( $dados["salario"], FILTER_VALIDATE_FLOAT)
     === false){
        $erros["salario"] = "o salario deve ser um numero decimal valido";
    }

    return $erros;
}

$erros = [];
$sucesso = false;
$colaborador = [
    'nome' => '',
    'email' => '',
    'matricula' => '',
    'salario' => ''
];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $colaborador["nome"] = sanitizarTexto($_POST["nome"] ?? "");
    $colaborador["email"] = sanitizarTexto($_POST["email"] ?? "");
    $colaborador["matricula"] = trim($_POST["matricula"] ?? "");
    $colaborador["salario"] = trim($_POST["salario"] ?? "");

    $erros = validarColaborador($colaborador);

    if (empty($erros)){
        $sucesso = True;
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       * {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
    background-color: #f2f4f7;
    color: #333;
}

h1 {
    text-align: center;
    color: #222;
    margin-bottom: 30px;
}

h2 {
    margin-top: 0;
}

/* Formulário */
form {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 11px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
}

input:focus {
    outline: none;
    border-color: #4a90e2;
}

/* Botão */
button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 6px;
    background-color: #4a90e2;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #357abd;
}

/* Área de erros */
body > div {
    max-width: 500px;
    margin: 0 auto 20px;
    padding: 15px 20px;
    background-color: #ffe5e5;
    border: 1px solid #ffb3b3;
    border-radius: 8px;
}

body > div h2 {
    color: #b00020;
    font-size: 18px;
}

body > div li {
    margin-bottom: 5px;
}

/* Mensagem de sucesso */
.success {
    max-width: 500px;
    margin: 0 auto;
    padding: 25px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.success h2 {
    color: #218838;
}

.success p {
    padding: 10px;
    margin: 8px 0;
    background-color: #f5f5f5;
    border-radius: 5px;
}

    </style>
</head>
<body>
    <h1>Cadastro de Colaborador</h1>

    <?php if (!empty($erros)): ?>
        <div>
            <h2>Erros encontrados:</h2>

            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= e($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($sucesso): ?>

        <h2>Colaborador cadastrado com sucesso!</h2>

        <p><strong>Nome:</strong> <?= e($colaborador['nome']) ?></p>
        <p><strong>E-mail:</strong> <?= e($colaborador['email']) ?></p>
        <p><strong>Matrícula:</strong> <?= e($colaborador['matricula']) ?></p>
        <p><strong>Salário:</strong> R$ <?= e($colaborador['salario']) ?></p>

    <?php else: ?>

        <form method="POST">

            <label for="nome">Nome:</label><br>
            <input
                type="text"
                id="nome"
                name="nome"
                value="<?= e($colaborador['nome']) ?>"
            >
            <br><br>

            <label for="email">E-mail:</label><br>
            <input
                type="text"
                id="email"
                name="email"
                value="<?= e($colaborador['email']) ?>"
            >
            <br><br>

            <label for="matricula">Matrícula:</label><br>
            <input
                type="text"
                id="matricula"
                name="matricula"
                value="<?= e($colaborador['matricula']) ?>"
            >
            <br><br>

            <label for="salario">Salário:</label><br>
            <input
                type="text"
                id="salario"
                name="salario"
                value="<?= e($colaborador['salario']) ?>"
            >
            <br><br>

            <button type="submit">Cadastrar</button>

        </form>

    <?php endif; ?>
</body>
</html>
