# Projeto de Conexão com Banco de Dados usando PDO, Singleton e PDOException

## Passo 1: Validando a extensão pdo_pgsql e o Servido do PostgreSQL

1. Abra o terminal e execute o seguinte comando:

```bash
php -m | findstr -i pgsql
```

Saída Esperada: Deve listar `pdo_pgsql` e o `pgsql`

Caso não aparecça:
* Abrir seu `php.ini`
* Localize a linha `;extention=pdo_pgsql`e remova o ponto e virgula inicial (`;`).
* salve o arquivo e valide novamente o comando

2. Validar o Serviço do PostgreSQL

Instalar uma extensão do VSCode -> PostgreSQL (Chris Kolkman)
e configurar uma conexão

## passo 2: estrutura de diretórios do projeto

Organize a raiz do projeto exatamente com a seguinte árvore de pastas:

```text
SAFormativa/
├── config/
│   └── database.ini        <- Credenciais protegidas
├── logs/
│   └── database.log        <- Arquivo gerado para auditoria de falhas
├── src/
│   └── ConexaoBanco.php    <- Classe Singleton com PDO para PostgreSQL
├── schema.sql              <- Script DDL e DML para o PostgreSQL
├── index.php               <- Painel de diagnóstico e testes operacionais
└── README.md               <- Documentação do projeto
```

## passo 3 executar o script DDL no postgreSQL(`schema.sql`)

```sql
-- Cria o banco de dados da biblioteca (caso use o terminal psql)
CREATE DATABASE biblioteca_escola WITH ENCODING 'UTF8';

-- Cria a tabela de acervo de livros
CREATE TABLE IF NOT EXISTS livros (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(120) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    preco NUMERIC(6,2) NOT NULL,
    status VARCHAR(15) NOT NULL DEFAULT 'DISPONIVEL' 
        CHECK (status IN ('DISPONIVEL', 'EMPRESTADO', 'RESERVADO')),
    data_cadastro TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Insere alguns livros iniciais para teste
INSERT INTO livros (titulo, autor, preco, status) 
VALUES 
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 39.90, 'DISPONIVEL'),
('Dom Casmurro', 'Machado de Assis', 29.90, 'EMPRESTADO'),
('1984', 'George Orwell', 45.00, 'RESERVADO');
```

## passo 4: criando arquivo de configuraçao (`config/database.ini)

Crie o arquivo. Ajuste as chaves de acesso ao banco de dado

