<?php
declare(strict_types=1);

require_once "AlmoxarifadoDAO.php";

require_once "conexaoBanco.php";

$dao = new almoxarifadoDao($pdo);
$pagina = (int)($_GET['p'] ?? 1);
$pagina = max(1, $pagina);

peças = $dao->listarPaginado($pagina);

echo "Página atual: $pagina\n";
echo "Peças encontradas: " . count($pecas) . "\n\n";

foreach ($pecas as $peca) {
    echo "ID: " . $peca['id'] . "\n";
    echo "Nome: " . $peca['nome'] . "\n";
    echo "Categoria: " . $peca['categoria'] . "\n";
    echo "Quantidade: " . $peca['quantidade'] . "\n";
    echo "-------------------------\n";
}
