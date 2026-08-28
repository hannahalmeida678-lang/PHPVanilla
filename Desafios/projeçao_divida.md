# DESAFIO EM SALA: SIMULADOR DE COBRANÇA (FINANSENAI)
- O banco  precisa de um painel financeiro que projete a evolução de uma dívida de um cliente inadimplente ao longo de 12 meses. O sistema deve calcular os "Juros Compostos" mês a mês.

**Regras de Negócio:**
- Classificação de Risco: O sistema deve avaliar a Categoria do Cliente ('A', 'B', 'C') utilizando a estrutura match e definir a taxa de juros:
- Categoria 'A' ➔ Juros de 0.01 (1% ao mês)
- Categoria 'B' ➔ Juros de 0.02 (2% ao mês)
- Categoria 'C' ➔ Juros de 0.03 (3% ao mês)
- Qualquer outra coisa (default) ➔ Juros de 0.05 (5% - Risco Máximo)
- Projeção da Dívida: Você deve usar um laço for para gerar exatamente 12 meses de dívida.

- Cálculo: Todo mês, o valor da dívida sofre um aumento. A fórmula de cada mês é: Juros do Mês = Dívida Atual * Taxa. O saldo atualizado passa a ser Dívida Atual + Juros do Mês.
- A Regra da Anistia: Por causa de uma campanha do banco, no 6º mês não haverá cobrança de juros! Você deve usar o comando continue para identificar o mês 6, pular o cálculo matemático, e imprimir uma mensagem de isenção na tabela.

- Crie um arquivo chamado projecao_divida.php e preencha os blocos faltantes.

## **resolução**

```php
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
```



