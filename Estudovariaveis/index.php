<?php 
declare(strict_types=1); // blinda o sistema contra misturas acidentais de tipos de dados
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estudo de variaveis</title>
</head>
<body>
   <h3>Estudo de Variáveis</h3>
   <?php
   // sintaxe para declarar uma variavel em php
   // variaveis são representadas pelo simbolo "$" seguido do nome de uma variavel
   //exemplo
   $nome = "hannah"; //variavel tipo string
   $idade = 16;// variavel tipo Number
   $status = true; //variavel do tipo boolean
   $altura = 1.60;//variavel do tipo number(float)
   $email = null; //variavel tipo null
   #$endereço; nao e possivel declarar uma variavel sem atribuir um avlor a ela, não existe Undefined em PHP 
//exibir as variaveis na tela
    echo "nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Status: $status <br>";
    echo "Altura: $altura <br>";
    echo "Email: $email <br>";

echo "<br> <h3> constantes <\h3> <br>";

//constantes são representadas pela palavra "const" ou "define" seguidas do nome da constante
const PI = 3.14; //constante do tipo number (float)
Const EMPRESA = "google"; //constante do tipo string
define ("SITE", "www.google.com");
// sempre declarar o nome da constante com letras maiusculas, e o "$" ,com letras minusculas.
echo "valor de pi: PI <br>";
echo "nome da empresa: EMPRESA <br.";
echo "Site: SITE <br>";
//tentando gerar o valor de uma constante, isso ira gerar um erro, pois constantes não podem ser alteradas
// PI = 3.14159; // isso e um erro
//redeclarar uma conatante tambem irá gerar um erro
  // const SITE = "www.google.com";//isso é um erro

  //Regra de ouro: Sempre coloque a instrução declare (strict_types=1); no inicio do seu codigo php, 
  //isso blinda o seu sistema contra mistura acidentais de tipo de dados.

  //utilização de textos (concatenação VS interpolaçâo)
//exemplo de concatenação -> juntar duas ou mais strings utilizando o operador "."
echo "olá, " . $nome . "! Seja bem-vindo ao nosso site !<br>";
 //exemplo de interpolação => utilização de variaveis dentro de um texto, utilizando aspas duplas
 echo "$nome, tem $idade anos e sua altura é $altura metros. <br>"; //forma de misturar texto e variaveis

?>



</body>
</html>