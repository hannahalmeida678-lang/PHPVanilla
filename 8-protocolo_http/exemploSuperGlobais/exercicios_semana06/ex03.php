<?php

declare(strict_types=1);
//variaveis
$email = "";
$loginValidado = false;
$erros= "";

//dados do formulário

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = trim($_POST["email"] ?? "");//limpar os espaços vazios

    $senha= trim($_POST["senha"] ?? "");

    if($email === "" || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erros["email"] = "informe um email válido!!";
    }

    if(strlen($senha) < 6){
        $erros["senha"] = "senha deve ter no minimo 6 digitos";
    }
 //se a senha e email ok

 if(empty($erros)){
    $emailCorreto = "admin@edu.senai.br";
    $senhaCorreta = "senhaSgura213";

    if($email === $emailCorreto && $senha === $senhaCorreta){
        $loginValidado = true;
    }else{
        $erros= "credenciais inválidas!";
    }
 }
}













































?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>