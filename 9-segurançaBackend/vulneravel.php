<?php 
//codigo vulneravel para fins de estudo de segurança
$nome = $_GET["nome"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>segurança vulneravel</title>
</head>
<body>
    <h1>perfil de usuario</h1>


    <!-- erro grave: O dado é impresso diretamente sem escapar! -->
     <p>bem-vindpo, <?php echo $nome; ?></p>
        <form action="vulneravel.php" method="GET">
        <label for="">digite seu nome</label>
       <input type="text" name="nome" value="<?php echo $nome ?>">
       <button type="submit">atualizar</button>
        
    </form>

</body>
</html>
