<?php
declare(strict_types=1);
require_once 'ContaBancaria.php';

final Class ContaSalario extends ContaBancaria{
    public readonly string $cnpjEmpregador;

    private int $saquesNoMes = 0;
    private string $mesContabil;

    private bool $depositoAutorizado = false;

    public function _Construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        string $cnpjEmpregador,
        float $saldoInicial = 0.0
    ){
    parent::__construct(
            $agencia,
            $numeroConta,
            $titular,
            $saldoInicial
        );
        $this->cnpjEmpregador = $cnpjEmpregador;
        $this->mesContabil = date('Y-m');
    }

    //deposito diretos são bloqueados.
    //deve passar pela validação do empregador.
    public function depositar(float $valor): void {
        if (!$this->depositoAutorizado){
            throw new RuntimeException( "deposito somente permitido pelo empregador autenticado.");
        }
    }
 // Valida o CNPJ do empregador antes de depositar.
    public function depositarDoEmpregador(
        float $valor,
        string $cnpjAutenticado
    ): void {
        if ($cnpjAutenticado !== $this->cnpjEmpregador) {
            throw new RuntimeException(
                'Empregador não autorizado para realizar o depósito.'
            );
}
$this->depositoAutorizado = true;
try {
    $this->depositar($valor);
} catch{
    $this->depositoAutorizado = false;
        }
}
 private function atualizarMes(): void
    {
        $mesAtual = date('Y-m');

        if ($this->mesContabil !== $mesAtual) {
            $this->saquesNoMes = 0;
            $this->mesContabil = $mesAtual;
        }
    }

    // Dois saques gratuitos por mês.
    // A partir do terceiro, cobra R$ 4,00.
    public function sacar(float $valor): void
    {
        $this->atualizarMes();
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }
        $taxa = ($this->saquesNoMes >= 2) ? 4.00 : 0.00;
        $valorTotal = $valor + $taxa;
        if ($this->saldo < $valorTotal) {
            throw new RuntimeException(
                'Saldo insuficiente para o saque e a taxa.'
            );
        }
        $this->saldo -= $valorTotal;
        $this->saquesNoMes++;
    }
    // Permite transferências apenas entre contas
    // vinculadas ao mesmo objeto Titular.
    public function transferir(
        float $valor,
        ContaBancaria $contaDestino
    ): void {
        if ($this->titular !== $contaDestino->titular) {
            throw new RuntimeException(
                'Transferência não permitida para outro titular.'
            );
        }
        if ($contaDestino === $this) {
            throw new ValorInvalidoException($valor);
        }
        if ($valor <= 0.0) {
            throw new ValorInvalidoException($valor);
        }
        // Se o destino também for uma conta salário,
        // autoriza o recebimento da transferência interna.
        if ($contaDestino instanceof ContaSalario) {
            $this->sacar($valor);
            $contaDestino->receberTransferenciaInterna($valor);
            return;
        }
        // Para as demais contas, utiliza a implementação da classe-pai.
        $this->transferir($valor, $contaDestino);
    }
    // Método interno para receber transferências autorizadas.
    private function receberTransferenciaInterna(float $valor): void
    {
        $this->depositoAutorizado = true;

        try {
            $this->depositar($valor);
        } catch {
            $this->depositoAutorizado = false;
        }
    }
}