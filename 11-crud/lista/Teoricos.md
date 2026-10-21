#  LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA 

1. **Definição de CRUD:** O que significa o acrônimo CRUD e qual é a correspondência direta de cada uma de suas letras com as instruções SQL no PostgreSQL?

> O acrônimo CRUD significa Create, Read, Update e Delete (Criar, Ler, Atualizar e Excluir). Ele representa as quatro operações básicas utilizadas em bancos de dados relacionais para gerenciar informações.

2. **Anatomia do SQL Injection:** Explique com suas próprias palavras como um atacante consegue alterar a lógica de uma consulta quando o código utiliza concatenação de strings com $_GET ou $_POST.

> quando o desenvolvedor utiliza a concatenação direta como `$_get`ou `$_POST` pra a intrução do sql, ele está tratando os dados enviados pelo usuario como parte do proprio comando executavel

3. **Mecanismo das Prepared Statements:** Por que o envio de uma consulta em duas etapas (prepare e depois execute) impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco?

> O mecanismo das Prepared Statements (ou consultas preparadas) impede a Injeção de SQL porque ele separa rigidamente a estrutura do código dos dados fornecidos pelo usuário.

4. Marcadores Nomeados: Qual é a vantagem de utilizar marcadores nomeados como `:sku` e `:preco` em vez de pontos de interrogação posicionais `(?)` em instruções SQL complexas?

> A principal vantagem de utilizar marcadores nomeados (como :sku e :preco) em vez de pontos de interrogação (?) é a legibilidade e a facilidade de manutenção do código, especialmente em instruções SQL complexas.

5. **Diferença entre Bindings:** Explique a diferença de comportamento entre os métodos `$stmt->bindValue()` e `$stmt->bindParam().`

• bindValue(): Associa o valor atual de uma variável (ou um valor direto) ao parâmetro. Se você alterar a variável depois, o valor enviado para o banco não muda.

• bindParam(): Associa uma referência (ponteiro) da variável ao parâmetro. O valor real só é lido no momento exato em que $stmt->execute() é chamado.

6. **Tipagem no PDO:** Qual é o risco de omitir o tipo de dado (ex: `PDO::PARAM_INT`) ao vincular uma variável que deveria ser estritamente numérica em uma cláusula LIMIT?

> O principal risco de omitir o tipo de dado ao vincular uma variável na cláusula LIMIT é que, por padrão, o PDO trata quase todos os valores vinculados via `execute()` ou `bindParam()/bindValue()` sem tipo explícito como strings `(PDO::PARAM_STR).`
Isso resulta em um erro de sintaxe SQL ou em uma vulnerabilidade dependendo das configurações do banco.

7. **Padrão DAO:** Qual é o benefício do padrão `Data Access` Object (DAO) em termos de manutenibilidade de software e do princípio de responsabilidade única (SOLID)?

> O principal benefício do padrão Data Access Object (DAO) em termos de manutenibilidade e do princípio de responsabilidade única (SRP) é o isolamento completo da lógica de persistência de dados da lógica de negócios da aplicação.

8. Operações de Update: Por que a ausência de uma cláusula `WHERE` em um comando `UPDATE` é considerada um incidente gravíssimo em ambientes de produção?

- A ausência de uma cláusula WHERE em um comando UPDATE é considerada um incidente gravíssimo porque, por padrão, os bancos de dados relacionais aplicam a alteração a todas as linhas da tabela.

> Sem a restrição do WHERE, o comando não sabe quais registros devem ser modificados. Como resultado, ele sobrescreve os dados de toda a base de clientes, produtos ou transações com o mesmo valor, causando uma destruição massiva e imediata de dados válidos.

9. **Impacto da LGPD:** De acordo com a Lei Geral de Proteção de Dados (LGPD), quais são as penalidades e impactos que uma organização pode sofrer caso ocorra vazamento de dados de clientes por falha de SQL Injection?

> Caso ocorra um vazamento de dados de clientes devido a uma falha de SQL Injection, uma organização estará vulnerável a graves penalidades administrativas, financeiras, operacionais e reputacionais, uma vez que a Lei Geral de Proteção de Dados (LGPD) obriga as empresas a adotarem medidas técnicas eficazes de segurança. O SQL Injection é uma vulnerabilidade amplamente conhecida e evitável, o que pode agravar a interpretação de negligência por parte dos órgãos fiscalizadores.
---