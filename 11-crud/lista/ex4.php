<?php
declare(strict_types=1);


require_once "almoxarifadoDAO.php";
require_once "conexaoBanco.php";

$dao = new almoxarifadoDao($pdo);

$sucesso = $dao->registrarMovimentacao(1, 3, 'saida');

if ($sucesso) {
    echo "Movimentação realizada com sucesso!";
} else {
    echo "Não foi possível realizar a movimentação.";
}

    // Registrar movimentação de estoque com transação
    public function registrarMovimentacao(
        int $pecaId,
        int $quantidade,
        string $tipo
    ): bool {
        // Validar os dados recebidos
        $tipo = strtolower(trim($tipo));

        if ($pecaId <= 0 || $quantidade <= 0) {
            return false;
        }

        if (!in_array($tipo, ['entrada', 'saida'], true)) {
            return false;
        }

        try {
            // Iniciar a transação
            $this->pdo->beginTransaction();

            // Buscar a peça e bloquear a linha durante a transação
            $sql = "SELECT quantidade
                    FROM pecas
                    WHERE id = :id
                    FOR UPDATE";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $pecaId, PDO::PARAM_INT);
            $stmt->execute();

            $peca = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar se a peça existe
            if (!$peca) {
                $this->pdo->rollBack();
                return false;
            }

            $estoqueAtual = (int) $peca['quantidade'];

            // Calcular o novo saldo
            if ($tipo === 'saida') {
                // Verificar se existe estoque suficiente
                if ($estoqueAtual < $quantidade) {
                    $this->pdo->rollBack();
                    return false;
                }

                $novoEstoque = $estoqueAtual - $quantidade;
            } else {
                // Entrada de peças no estoque
                $novoEstoque = $estoqueAtual + $quantidade;
            }

            // Atualizar a quantidade da peça
            $sql = "UPDATE pecas
                    SET quantidade = :quantidade
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(
                ':quantidade',
                $novoEstoque,
                PDO::PARAM_INT
            );
            $stmt->bindValue(':id', $pecaId, PDO::PARAM_INT);
            $stmt->execute();

            // Confirmar a transação
            $this->pdo->commit();

            return true;

        } catch (Throwable $e) {
            // Desfazer alterações se a transação ainda estiver ativa
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            return false;
        }
    }


