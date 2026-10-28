# LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA

1- Procedural vs. OO: Quais são os três principais riscos técnicos de manter regras financeiras críticas implementadas puramente através de arrays associativos e scripts procedurais?

> Manter regras financeiras críticas implementadas puramente através de scripts procedurais e arrays associativos expõe sistemas de missão crítica a sérios problemas de estabilidade e integridade dos dados

2-Ciclo de Vida do Objeto: O que ocorre na memória Heap do servidor quando a instrução new ContaCorrente(...) é executada? Qual é o papel do método __construct() nesse processo?


> quando a instrução `new ContaCorrente()` é executada, a memoria Heap do servidor aloca um novo espaço fisico para armazenar os atributos daquele objeto especifico, isolando-o de utras instancias.

3- A Pseudo-Variável $this: Explique por que o comando `$this->saldo` é obrigatório para acessar um atributo dentro da classe, diferenciando-o de uma variável local $saldo.

> Em PHP, o uso de `$this->saldo` é obrigatório dentro de um método para indicar explicitamente que você está manipulando um atributo do objeto (escopo da classe), e não uma variável local (escopo do método)

4- **Encapsulamento e Invariantes:** Por que um desenvolvedor sênior de back-end nunca deve criar um método `public function setSaldo(float $novoSaldo)` para uma conta bancária?

> Um desenvolvedor sênior nunca criaria um método setSaldo() público porque ele quebra o encapsulamento e viola as invariantes de negócio da aplicação. Em sistemas financeiros, o saldo de uma conta nunca é simplesmente "substituído" por um novo valor; ele é o resultado acumulado de operações legítimas, como depósitos, saques e transferências.

5- **Modificadores de Acesso:** Qual é a diferença prática entre os modificadores `private` e `protected` quando subclasses entram em cena através do `extends`?

>A principal diferença prática entre private e protected no contexto de herança (extends) diz respeito à visibilidade direta dos membros (atributos e métodos) pela subclasse.

6- **Constructor Property Promotion:** Como o recurso de promoção de propriedades introduzido no PHP 8 reduz o *boilerplate* e melhora a legibilidade do código?

> A Promoção de Propriedades de Construtor (Constructor Property Promotion), introduzida no PHP 8, reduz o boilerplate e melhora a legibilidade ao combinar a declaração de atributos, a assinatura do construtor e a atribuição de valores em uma única sintaxe.

7-**Propriedades readonly:** Explique o mecanismo de segurança proporcionado pela palavra-chave readonly em atributos de classes de valor como `Titular` ou `CPF`.

> A palavra-chave readonly em atributos de classes de valor (como Titular ou CPF) proporciona um mecanismo de segurança baseado na imutabilidade.
Em termos simples, ela garante que o valor do atributo só possa ser definido no momento da criação do objeto (geralmente no construtor) e nunca mais seja alterado durante o ciclo de vida do programa.

8- **Classes Abstratas:** Por que faz todo sentido no modelo bancário que a classe ContaBancaria seja declarada como `abstract` enquanto *ContaCorrente* e *ContaPoupanca* são classes concretas?

> Tornar a classe ContaBancaria abstrata no modelo de um banco faz todo o sentido porque, no mundo real, uma "conta bancária" pura não existe de forma isolada, mas sim como um conceito que define o que toda conta deve ter e fazer.

9- **Polimorfismo:** Como o método transferir(*float $valor, ContaBancaria $destino*) consegue operar transferências entre quaisquer tipos de contas filhas sem precisar saber qual é a classe exata da conta de destino?

> O método consegue operar dessa forma graças ao Polimorfismo de Subtipagem (ou inclusão) aliado à Tipagem por Sugestão de Tipo (Type Hinting) do PHP.
Como a assinatura do método define o parâmetro utilizando a classe base ContaBancaria `$destino`, o PHP aceita qualquer objeto que seja uma instância direta de ContaBancaria ou de suas classes filhas (como ContaCorrente, ContaPoupanca, etc.).

10- Exceções de Domínio: Por que é uma péssima prática retornar `false` ou `null` quando uma operação de saque é rejeitada por falta de saldo?

> Retornar false ou null quando uma operação de saque falha por falta de saldo é considerado uma péssima prática no design de software (especialmente no Domain-Driven Design - DDD) porque isso oculta a intenção do negócio, transfere a responsabilidade de validação para quem chama a função e descaracteriza a expressividade do domínio.