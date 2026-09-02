<?php
$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12],
    ["titulo" => "swaped", "genero" => "Animação", "classificacao_idade" => 0]
];


$filmesInfantis = array_filter(
    $filmes,
    fn($filme) => $filme["classificacao_idade"] <= 12
);



?>