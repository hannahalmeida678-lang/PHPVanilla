<?php

$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00],
];

$total_folha = 0;

echo "<table border = '1'>";

echo "<tr>";
echo"<th>id</th>";
echo"<th>nome</th>";
echo"<th>cargo</th>";
echo"<th>salario</th>";
echo"</tr>";

foreach ($funcionarios as $funcionario) {
    echo $funcionario["id"];
    echo $funcionario["nome"];
    echo $funcionario["cargo"];
    echo "<td>R$ " . number_format($funcionario["salario"], 2, ",", ".") . "</td>";

    echo "</tr>";

    $total_folha += $funcionario["salario"]; 
}

echo "</table>"; echo "<p>Total da folha: R$ " . number_format($total_folha, 2, ",", ".") . "</p>";

?>

