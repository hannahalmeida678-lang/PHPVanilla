
<?php

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

$totalEntradas = 0;
$totalSaidas = 0;

foreach ($extrato as $transacao) {

    if ($transacao["tipo"] == "Entrada") {
        $totalEntradas += $transacao["valor"];
    }

    if ($transacao["tipo"] == "Saida") {
        $totalSaidas += $transacao["valor"];
    }
}

$saldoAtual = $totalEntradas - $totalSaidas;

echo "Total de entradas: R$ " . number_format($totalEntradas, 2, ",", ".") . "<br>";
echo "Total de saídas: R$ " . number_format($totalSaidas, 2, ",", ".") . "<br>";
echo "Saldo atual: R$ " . number_format($saldoAtual, 2, ",", ".") . "<br>";

echo "-------------------------";

foreach ($extrato as $transacao) {
    echo "Data: " . $transacao["data"];
    echo "Descrição: " . $transacao["descricao"];
    echo "Tipo: " . $transacao["tipo"];
    echo "Valor: R$ " . number_format($transacao["valor"], 2, ",", ".");
    echo "-------------------------";
}

$gastosAltos = array_filter(
    $extrato,
    fn($transacao) => $transacao["tipo"] == "Saida" && $transacao["valor"] > 100
);

echo "Atenção: Gastos Altos do Mês";

foreach ($gastosAltos as $gasto) {
    echo "Descrição: " . $gasto["descricao"];
    echo "Valor: R$ " . number_format($gasto["valor"], 2, ",", ".");
    echo "-------------------------";
}

?>

