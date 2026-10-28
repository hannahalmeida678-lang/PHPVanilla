<?php
declare(strict_types=1);
//Simulador do Sistema

// Carga dos arquivos das classes
require_once __DIR__ . '/src/Exceptions/ContaException.php';
require_once __DIR__ . '/src/Exceptions/SaldoInsuficienteException.php';
require_once __DIR__ . '/src/Exceptions/ValorInvalidoException.php';
require_once __DIR__ . '/src/Dominio/Titular.php';
require_once __DIR__ . '/src/Dominio/ContaBancaria.php';
require_once __DIR__ . '/src/Dominio/ContaCorrente.php';
require_once __DIR__ . '/src/Dominio/ContaPoupanca.php';

$logsOperacionais = [];

//tratamento de erros acontece dentro do TRYCatch
try {
    //1. Criar os Titulares da Contas
    $titular1 = new Titular("Carlos Eduardo Gonçalves", "123.456.789.10");
    $titular2 = new Titular("Douglas Alves da Silva", "987.654.321-01");
    

    //2. Instanciar as Contas
    $cc = new ContaCorrente("0001", "1010-1", $titular1, 1000.00, 300.00);
    $cp = new ContaPoupanca("0001", "2020-5", $titular2, 500.00);

    $logsOperacionais[] = "Contas cridas com sucesso para {$titular1->nome} e {$titular2->nome}";

    //3. Saque com cobrança de taxa CC
    $cc->sacar(200.00);
    $logsOperacionais[] = "Saque de R$200,00 efetuado na Conta Corrente (Tarifa de 2.50) . Saldo atual: R$ ". number_format($cc->getSaldo(), 2,",", ".");
    
    //4. Transferência de conta com polimorfismo
    $cc->transferir(300.00, $cp);
    $logsOperacionais[] = "Transferência de R$ 300,00 efetuado com sucesso da Conta Corrente para a Poupança";

    //5. Aplicação de juros de rendimento na Poupança
    $cp->renderJuros(1.5);
    $logsOperacionais[] = "REndimento de Jutos de 1,5% creditado na Poupança. Saldo atual: R$ ". number_format($cp->getSaldo(), 2, ",", ".");
   
    //6. teste de tentativa de saque invalido para simular captura de exceção
    $cp->sacar(50000.00);

} catch (ContaException $e){
    $logsOperacionais[] = "Erros de Dominio Capturados" . $e->getMessage();
} catch (\Throwable $th) {
    $logsOperacionais[] = "Errod Inesperados: " . $th->getMessage();
}

?>

