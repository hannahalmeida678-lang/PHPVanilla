# Parte A: Exercícios Teórico:
1- Conceito de função: Explique com suas palavras o que é uma função e cite duas vantagens de dividir um programa em funções.

- as funções são blocos de codigos que são reutilizaveis e executam uma tarefa especifica quando chamados no codigo.

2- Princípio DRY: Por que repetir o mesmo bloco de código em várias partes do sistema pode causar problemas de manutenção? Como uma função ajuda a evitar essa repetição?

- qualquer alteração futura exige a modificação do sistema em varios lugares diferentes, aumentando chances de erro.
- Uma função é um bloco de código nomeado que executa uma tarefa específica. Em vez de repetir o código, você coloca ele dentro de uma função

3- Parâmetros e retorno: Explique a diferença entre um parâmetro e um valor retornado por uma função. Use a função abaixo como exemplo:

```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}
```

- um parametro é o dado que entra na função, enquanto o valor retornado é o resultado que a função devolve após o prcessamento.

4- Tipagem: Identifique o tipo de cada elemento na declaração:
```php
 function cadastrar(string $nome, int $idade): bool.
 ```
- `function`: palavra-chave para iniciar a criação da função; 

- `cadastrar`: nome da função
- `string`: o tipo do primeiro parametro.
- `$nome`: nome da variavel
- `int`: tipo do segundo parametro.
- `$idade`: Nome da variavel do segundo parametro
- `bool`: tipo de dado que a função devolve no final, aceitando apenas valores booleanos(`true` or `false`).


5- void e return: Qual é a diferença entre uma função que retorna string e uma função que retorna void? Dê um exemplo de uso para cada uma.

- Uma função que retorna `string`  devolve um texto  para ser usado apenas em outra parte do codigo, enquando uma função `void` apenas executa uma tarefa e não devolve valor algum. 

exemplo(string):

```php
$nome = hannah
function saudar($nome) {
    return "olá, $nome !";
}
$mansagem = saudar($nome);
echo $mensagem;

```

Exemplo(void):

```php 
function exibirMensagemErro(string $erro): void {
    echo "Erro encontrado: " . $erro;
}

exibirMensagemErro("Arquivo não encontrado."); 
// A função executa o echo diretamente, sem retornar valor.
```
6- Escopo: Por que a função abaixo não consegue acessar $cliente diretamente? Explique duas formas de corrigir o código e indique qual é a mais recomendada.
```php
$cliente = "Mariana";

function exibirCliente(): string {
    return $cliente;
}
```
- pois no php, as funçoes possuem um escopo isolado, o que significa que vairiaveis criadas fora da função não são conhecidas dentro da função.

7- Referência: O que muda quando um parâmetro é declarado como float &$valor? Explique a diferença entre alterar uma cópia e alterar a variável original.

- Quando um parâmetro é declarado como `float &$valor`, o símbolo `&` significa que a variável está sendo passada por referência, e não por valor.

8- Funções nativas: Escolha cinco funções da tabela deste material e descreva: categoria, finalidade, parâmetros principais e valor retornado.

| Função | Categoria | O que faz | |
|---|---|---|---|
| `strlen()` | Strings | Retorna a quantidade de caracteres de um texto. | |
| `implode()` | Arrays | Junta os itens de um array em um único texto. ` | |
| `max()` | Números | Retorna o maior valor de uma lista ou array. |  |
| `isset()` | Validação | Verifica se uma variável existe e não possui valor `null`. |  |
| `file_put_contents()` | Arquivos | Grava conteúdo em um arquivo, criando-o se necessário. |  |

9- Previsão de saída: Qual será o resultado exibido pelo código abaixo? Explique o motivo.

```php
function aplicarDesconto(float $preco): float {
    return $preco * 0.90;
}

$valor = 100.00;
echo aplicarDesconto($valor);
echo $valor;
```

10 - Documentação: Pesquise na documentação oficial do PHP a função strlen() e anote sua sintaxe, o parâmetro recebido e o tipo de retorno.


a função `strlen` serve para retornar o valor de uma string em bytes, EX:

```php
#include <stdio.h> <--o arquivo de cabeçalho padrão da linguagem C que gerencia operações de entrada e saída de dados
#include <string.h>

int main() {
    char texto[] = "Olá, mundo!";
    int tamanho = strlen(texto);
    
    printf("O texto tem %d caracteres.\n", tamanho);
    return 0;
}
// Saída: O texto tem 11 caracteres.
```
