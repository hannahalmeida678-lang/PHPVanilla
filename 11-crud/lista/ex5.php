<?php
declare(strict_types=1);

require_once "AlmoxarifadoDAO.php";
require_once "conexao.php";

$dao = new AlmoxarifadoDAO($pdo);

// ID da peça que será desativada
$id = 1;

// Consultar a peça antes da exclusão lógica
$pecaAntes = $dao->buscarPorId($id);

if ($pecaAntes === null) {
    echo "Peça não encontrada.\n";
    exit;
}

// Desativar a peça
if ($dao->excluir($id)) {
    echo "Exclusão lógica executada.\n";
}

// Verificar diretamente se o registro continua no banco
$sql = "SELECT id, nome, quantidade, ativo
        FROM pecas
        WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$pecaDepois = $stmt->fetch(PDO::FETCH_ASSOC);

if ($pecaDepois !== false) {
    echo "Registro continua armazenado no banco.\n";
    echo "ID: " . $pecaDepois["id"] . "\n";
    echo "Nome: " . $pecaDepois["nome"] . "\n";
    echo "Quantidade: " . $pecaDepois["quantidade"] . "\n";
    echo "Ativo: "
        . ($pecaDepois["ativo"] ? "Sim" : "Não")
        . "\n";
} else {
    echo "Registro não encontrado.\n";
}


//Camada de Acesso a Dados (DAO) para Almoxarifado
//essa Camada é uma Classe - usa Paradigma de Programação Orientada ao Objeto

final class AlmoxarifadoDAO{
    //atributos -> as caracteristicas do objeto
    private PDO $pdo;

    // métodos -> ações
    //método que toda classe tem -> Construtor -> permite instanciar objetos
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    // métodos do CRUD

    //Read
    //lisatr todos -> busca as informações no banco e retorna um vetor com essa informações 
    public function listarTodos(): array {
   $sql = "SELECT * FROM pecas
                WHERE ativo = TRUE
                ORDER BY id DESC";

                $stmt = $this->pdo->query($sql);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    }

    //listar uma peça específica pelo id
    public function buscarPorId(int $id): ?array { // eu esperando o retorno de um array, porém, aceita um retorno nulo também
        $sql= "SELECT * FROM pecas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$id, PDO::PARAM_INT); //garantindo a que o valor do parâmetro seja passado como um nº inteiro
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    //CREATE => Salva informações no Banco
    public function salvar(array $dados): bool {
        $sql = "INSERT INTO pecas
        (nome, descricao, categoria, quantidade, preco_unitario)
        VALUES (:nome, :descricao, :categoria, :quantidade, :preco)";
        //se tem entrada de dados por input , fazer o prepare
        $stmt = $this->pdo->prepare($sql);

        $resultado = $stmt->execute([
            ":nome"          => strtoupper((trim($dados["nome"]))),
            ":descricao"    => trim($dados["descricao"]),
            ":categoria"    => trim($dados["categoria"]),
            ":quantidade"   => (int)$dados["quantidade"], //estou fazendo um "CAST" para inteiro -> convertendo o dados para um nº inteiro
            ":preco"        => (float)$dados["preco_unitario"]//CAST para float
        ]);

        return $resultado; //retrona true or false
    }

    //Update
    public function atualizar(int $id, array $dados):bool{
        $sql = "UPDATE pecas
                SET nome = :nome, 
                    descricao = :descricao, 
                    categoria = :categoria, 
                    quantidade = :quantidade, 
                    preco_unitario = :preco
                WHERE id = :id";

        //se tem entrada de dados por input , fazer o prepare
        $stmt = $this->pdo->prepare($sql);

        $resultado = $stmt->execute([
            ":id"           => $id,
            ":sku"          => strtoupper((trim($dados["nome"]))),
            ":descricao"    => trim($dados["descricao"]),
            ":categoria"    => trim($dados["categoria"]),
            ":quantidade"   => (int)$dados["quantidade"],
            ":preco"        => (float)$dados["preco_unitario"]
        ]);
        return $resultado;
    }
    
    //Deletar => Excluir do Banco
    public function excluir (int $id): bool {
        $sql = "update pecas 
        SET ativo = FALSE
        WHERE id = :id";
        $stmt = $this->pdo->query($sql);
        stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    }

    //buscar produtos por termo => busca textual 
    public function buscarPorTermo(string $termo):array {
        $sql = "SELECT * FROM pecas
                WHERE nome ILIKE :termo OR descricao ILIKE :termo OR categoria ILIKE :termo
                ORDER BY descricao ASC";
        $stmt = $this->pdo->prepare($sql);
         $stmt->execute([":termo" => "%" .trim($termo) . "%"]); //buscas em qualquer parte da palavra
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}