
1- Abstração de Dados: O que é o PDO no PHP e por que ele é preferível em relação a extensões especializadas procedurais como o antigo pgsql em projetos corporativos?

> O PDO (PHP Data Objects) é uma extensão do PHP que define uma interface leve e consistente para acessar bancos de dados. Ele funciona como uma camada de abstração de dados, o que significa que, independentemente de qual banco de dados você esteja usando (PostgreSQL, MySQL, SQLite, Oracle), as funções e métodos para executar queries e buscar dados serão exatamente os mesmos.

2- Ciclo do DSN: Explique o que é a string DSN e detalhe a finalidade de cada um dos parâmetros configurados para o PostgreSQL (host, port, dbname).

> Uma string DSN (Data Source Name) é uma estrutura de texto padronizada que consolida todas as informações necessárias (endereço, credenciais, protocolos e parâmetros adicionais) para que uma aplicação consiga localizar, autenticar-se e estabelecer comunicação com uma fonte de dados, como o gerenciador de banco de dados GeeksforGeeks Stack Overflow.

3- Padrão de Portas: Qual é a porta padrão de escuta do SGBD PostgreSQL (5432) e como ela é referenciada dentro da string de conexão?

> A porta padrão de escuta do SGBD PostgreSQL é a 5432.
Dentro de uma string de conexão (URI de conexão), ela é referenciada logo após o caractere de dois-pontos (:) que segue o host (endereço do servidor).

4- Flags de Integridade: O que acontece quando definimos o atributo PDO::ATTR_ERRMODE com o valor PDO::ERRMODE_EXCEPTION? Qual seria o comportamento padrão caso essa flag não fosse definida?

> Quando você define o atributo PDO::ATTR_ERRMODE como PDO::ERRMODE_EXCEPTION, o PHP passa a lançar uma exceção (PDOException) sempre que ocorrer um erro de banco de dados.

5- Fetch Mode: Qual é a vantagem de utilizar PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC para o consumo de memória RAM do servidor?

> A principal vantagem de utilizar PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC para o consumo de memória RAM é a redução imediata de quase 50% do uso de memória por linha recuperada em comparação ao comportamento padrão do PDO.

6- Padrão Singleton: Por que abrir uma nova conexão com new PDO() a cada consulta executada no PostgreSQL pode esgotar o limite de max_connections do servidor?

> O uso do padrão Singleton ajuda a evitar o esgotamento do limite de max_connections no PostgreSQL porque ele garante que apenas uma única instância da conexão PDO seja criada e reaproveitada por toda a aplicação.

7- Encapsulamento do Singleton: Por que o construtor da classe ConexaoBanco precisa ser declarado como private e quais métodos mágicos devem ser bloqueados para garantir a unicidade da instância?

> O construtor da classe ConexaoBanco precisa ser declarado como private para impedir a criação de novas instâncias fora da classe por meio do operador new. Isso garante que a própria classe controle seu ciclo de vida, forçando o uso de um único ponto de acesso global.

8- Segurança de Credenciais: Por que nunca devemos deixar o usuário e senha do banco de dados salvos de forma estática (hardcoded) dentro dos scripts PHP do projeto?
Tratamento de Exceções & LGPD: Por que a exibição direta de $e->getMessage() de uma PDOException na tela do navegador é considerada uma falha grave de segurança (Information Disclosure)?

> Deixar credenciais de banco de dados estáticas (hardcoded) expõe o sistema a invasões, enquanto exibir mensagens de erro cruas (PDOException) vaza dados estruturais que facilitam ataques direcionados. Ambos os comportamentos violam boas práticas globais de segurança e regulamentações como a LGPD (Lei Geral de Proteção de Dados).