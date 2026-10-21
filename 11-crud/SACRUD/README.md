# Situação de Aprendizagem Formativa - Criação de um CRUD com PDO e Proteção contra SQL Injection

## Passo 1 -  Montagem das Estruturas de Diretórios e Arquivos da Aplicação 

```text
SACRUD/
|__ config/
|    |__ database.ini        <-Credencias Protegidas de acesso ao Banco de Dados>
|__ logs/
|    |__databese.log         <- Time de Desenvolvimento recebe os logs de Falhas do Sistema
|__ src/
|    |__ConexaoBanco.php     <- Classe Singleton de conexão com PDO
|    |__AlmoxarifadoDAO.php  <- Camada de acesso a dados (CRUD com Prepared Statement)
|__ index.php                <- Controlador e interface visual
|__ schema.sql               <- Script do banco de Dados
|__ .gitignore               <- arquivos fora do versionamento
|__ README.md                <- Documentação do PRojeto

```

## Passo 2 - Criar a Estrutura do Banco de Dados (`schema.sql`)

```sql
--Criação do banco
CREATE DATABASE almoxarifado_senai WITH ENCODING 'UTF8';

-- Criação da tabela de peças industriais do almoxarifado
CREATE TABLE IF NOT EXISTS pecas_industriais (
    id SERIAL PRIMARY KEY,
    codigo_sku VARCHAR(20) NOT NULL UNIQUE,
    descricao VARCHAR(100) NOT NULL,
    categoria VARCHAR(40) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0 CHECK (quantidade >= 0),
    preco_unitario NUMERIC(10,2) NOT NULL CHECK (preco_unitario > 0),
    data_cadastro TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Carga inicial de dados para homologação
INSERT INTO pecas_industriais (codigo_sku, descricao, categoria, quantidade, preco_unitario) 
VALUES 
('ROL-SKF-6205', 'Rolamento Rigido de Esferas SKF 6205', 'Mecanica', 45, 89.90),
('COR-V-A42', 'Correia Industrial em V Perfil A-42', 'Transmissao', 120, 24.50),
('DISJ-TER-32A', 'Disjuntor Termomagnetico Tripolar 32A', 'Eletrica', 18, 145.00),
('VALV-SOL-24V', 'Valvula Solenoide Pneumatica 5/2 Vias 24V', 'Pneumatica', 8, 310.00)
ON CONFLICT (codigo_sku) DO NOTHING;
```

## Passo 3 - Arquivo de Configuração de Banco de Dados (`config/database.ini`)

Configurar as Credenciais no .ini

```ini
; Configurações de Conexão com o PostgreSQL 16+
[database]
db_driver   = pgsql
db_host     = 127.0.0.1
db_port     = 5432
db_name     = palmoxarifado_senai
db_user     = postgres
db_pass     = postgres
```


## 4 -  Classe Singleton de Conexão com Banco de Dados (`src/ConexaoBanco.php`)

usar o arquivo feito na aula passada

## PAsso 5 - Criar a Arquivo `.gitignore`

```git
config/
logs/
```

## Passo 6 - Construção da Camada DAO (`src/almoxarifadoDAO.php`)

Esta classe vai encapsular a 4 operações (CRUD) utilizando *Preparedm Statement*


