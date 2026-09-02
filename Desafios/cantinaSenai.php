

<?php

// Array com os produtos da cantina
$produtos = [
    1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10],
    2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8],
    3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5],
    4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6]
];

$pedido = [];
$opcao = 0;

// MENU PRINCIPAL
do {

    echo "\n==============================\n";
    echo "       CANTINA SENAI\n";
    echo "==============================\n";
    echo "1 - Listar produtos\n";
    echo "2 - Adicionar produto ao pedido\n";
    echo "3 - Exibir resumo do pedido\n";
    echo "4 - Finalizar compra\n";
    echo "0 - Sair sem finalizar\n";
    echo "==============================\n";

    $opcao = (int) readline("Escolha uma opção: ");

    // Match para encaminhar cada opção
    $acao = match ($opcao) {

        // OPÇÃO 1
        1 => function () use (&$produtos) {

            echo "\n--- PRODUTOS DISPONÍVEIS ---\n";

            foreach ($produtos as $codigo => $produto) {
                echo "Código: $codigo\n";
                echo "Nome: {$produto['nome']}\n";
                echo "Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
                echo "Estoque: {$produto['estoque']}\n";
                echo "--------------------------\n";
            }
        },

        // OPÇÃO 2
        2 => function () use (&$produtos, &$pedido) {

            echo "\n--- ADICIONAR PRODUTO ---\n";

            $codigo = (int) readline("Digite o código do produto: ");

            // Verifica se o produto existe
            if (!isset($produtos[$codigo])) {
                echo "Produto inexistente!\n";
                return;
            }

            // Enquanto a quantidade for inválida, continua perguntando
            $quantidade = 0;

            while (
                $quantidade <= 0 ||
                $quantidade > $produtos[$codigo]['estoque']
            ) {

                $quantidade = (int) readline(
                    "Digite a quantidade (estoque disponível: {$produtos[$codigo]['estoque']}): "
                );

                if ($quantidade <= 0) {
                    echo "A quantidade deve ser maior que zero!\n";
                } elseif ($quantidade > $produtos[$codigo]['estoque']) {
                    echo "Quantidade maior que o estoque disponível!\n";
                }
            }

            // Diminui o estoque
            $produtos[$codigo]['estoque'] -= $quantidade;

            // Adiciona ao pedido
            if (isset($pedido[$codigo])) {

                $pedido[$codigo]['quantidade'] += $quantidade;

            } else {

                $pedido[$codigo] = [
                    "nome" => $produtos[$codigo]['nome'],
                    "preco" => $produtos[$codigo]['preco'],
                    "quantidade" => $quantidade
                ];
            }

            echo "Produto adicionado ao pedido!\n";
        },

        // OPÇÃO 3
        3 => function () use (&$pedido) {

            echo "\n--- RESUMO DO PEDIDO ---\n";

            if (empty($pedido)) {

                echo "Nenhum produto foi adicionado.\n";

            } else {

                $total = 0;

                foreach ($pedido as $item) {

                    $subtotal = $item['quantidade'] * $item['preco'];

                    echo "Nome: {$item['nome']}\n";
                    echo "Quantidade: {$item['quantidade']}\n";
                    echo "Preço unitário: R$ "
                        . number_format($item['preco'], 2, ',', '.') . "\n";
                    echo "Subtotal: R$ "
                        . number_format($subtotal, 2, ',', '.') . "\n";
                    echo "--------------------------\n";

                    $total += $subtotal;
                }

                echo "TOTAL: R$ "
                    . number_format($total, 2, ',', '.') . "\n";
            }
        },

        // OPÇÃO 4
        4 => function () use (&$pedido) {

            echo "\n--- FINALIZAR COMPRA ---\n";

            if (empty($pedido)) {

                echo "Não é possível finalizar. O pedido está vazio.\n";
                return false;
            }

            // FOR para calcular o total
            $itens = array_values($pedido);
            $total = 0;

            for ($i = 0; $i < count($itens); $i++) {

                $subtotal =
                    $itens[$i]['quantidade'] *
                    $itens[$i]['preco'];

                $total += $subtotal;
            }

            echo "Valor da compra: R$ "
                . number_format($total, 2, ',', '.') . "\n";

            echo "\nForma de pagamento:\n";
            echo "1 - Pix (5% de desconto)\n";
            echo "2 - Cartão (sem desconto)\n";
            echo "3 - Dinheiro (3% de desconto)\n";

            $pagamento = (int) readline("Escolha: ");

            // Match para aplicar o desconto
            $resultado = match ($pagamento) {

                1 => [
                    "forma" => "Pix",
                    "desconto" => $total * 0.05
                ],

                2 => [
                    "forma" => "Cartão",
                    "desconto" => 0
                ],

                3 => [
                    "forma" => "Dinheiro",
                    "desconto" => $total * 0.03
                ],

                default => null
            };

            if ($resultado === null) {

                echo "Pagamento inválido!\n";
                return false;
            }

            $valorFinal = $total - $resultado['desconto'];

            echo "\n==============================\n";
            echo "COMPRA FINALIZADA!\n";
            echo "Pagamento: {$resultado['forma']}\n";
            echo "Desconto: R$ "
                . number_format($resultado['desconto'], 2, ',', '.') . "\n";
            echo "Total a pagar: R$ "
                . number_format($valorFinal, 2, ',', '.') . "\n";
            echo "Obrigado pela compra!\n";
            echo "==============================\n";

            return true;
        },

        // OPÇÃO 0
        0 => function () {
            echo "Saindo sem finalizar a compra...\n";
            return false;
        },

        // OPÇÃO INVÁLIDA
        default => function () {
            echo "Opção inválida! Tente novamente.\n";
            return false;
        }
    };

    // Executa a função escolhida pelo match
    $finalizou = $acao();

    // Se finalizou a compra ou escolheu sair
    if ($opcao === 4 && $finalizou === true) {
        break;
    }

    if ($opcao === 0) {
        break;
    }

    // continue volta para o início do menu
    if ($opcao !== 1 && $opcao !== 2 && $opcao !== 3 && $opcao !== 4) {
        continue;
    }

} while ($opcao !== 4 && $opcao !== 0);

echo "\nPrograma encerrado.\n";

?>

