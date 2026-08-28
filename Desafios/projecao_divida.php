<?php  
//Dados do criente 
$categoria = 'B';
$divida = 10000;

//Classificação de risco 
if ($categoria === 'A') {
    $taxa = 0.01;
}
elseif ($categoria === 'B') {
    $taxa = 0.02;
}
elseif ($categoria === 'C') {
    $taxa = 0.03; 
} else {
    $taxa = 0.05;
}

echo "categoria: $categoria\n";
echo "taxa: " . ($taxa * 100) . "% ao mes\n\n";

echo "mês | divida inicial | Juros | Divida atualizada\n ";

for ($mes = 1; $mes <= 12; $mes++){
     $dividaInicial = $divida;

     if ($mes == 6) {
        echo "$mes | $dividaInicial | insento | $divida\n";
        continue;
     }
     $juros = $divida *$taxa;
     $divida = $divida + $juros;

     echo "$mes | $dividaInicial | $juros | $divida\n";
}//\n quer dizer quebra de linha
?>


