
<?php

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

$carrinhoBlackFriday = array_map(
    fn($item) => [
        "produto" => $item["produto"],
        "preco" => $item["preco"] * 0.80
    ],
    $carrinho
);

foreach ($carrinhoBlackFriday as $item) {
    echo "Produto: " . $item["produto"] . "<br>";
    echo "Novo preço: R$ " . number_format($item["preco"], 2, ",", ".") . "<br>";
    echo "-------------------<br>";
}

?>

