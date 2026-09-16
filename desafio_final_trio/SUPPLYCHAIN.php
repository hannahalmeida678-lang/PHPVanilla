<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

const CATEGORIAS_PERMITIDAS = [
    'Eletrônicos',
    'Mecânica',
    'Consumíveis',
    'Serviços'
];

const CONDICOES_PAGAMENTO = [
    'À Vista',
    '30 dias',
    '60 dias',
    '90 dias'
];

// Dados iniciais das cotações
$cotacoesAbertas = [
    [
        'id' => 1,
        'fornecedor' => 'Eletro Parts Ltda',
        'email' => 'contato@eletroparts.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Bobinas de cobre 2mm - 100kg',
        'valor' => 4500.00,
        'prazo' => 7,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-10'
    ],
    [
        'id' => 2,
        'fornecedor' => 'Peças Mecânicas do Brasil',
        'email' => 'vendas@pecasmec.com.br',
        'categoria' => 'Mecânica',
        'descricao' => 'Rolamentos de esferas NSK 6204',
        'valor' => 1250.50,
        'prazo' => 5,
        'condicao' => 'À Vista',
        'data_abertura' => '2026-09-12'
    ],
    [
        'id' => 3,
        'fornecedor' => 'Supply Express',
        'email' => 'compras@supplyexpress.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Óleo hidráulico ISO 46 - 200L',
        'valor' => 2100.00,
        'prazo' => 3,
        'condicao' => '60 dias',
        'data_abertura' => '2026-09-15'
    ],
    [
        'id' => 4,
        'fornecedor' => 'Serviços Técnicos SENAI',
        'email' => 'servicos@senaigeral.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Manutenção preventiva - 40h',
        'valor' => 3200.00,
        'prazo' => 1,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-14'
    ]
];


function converterParaFloat($valorStr): ?float {
    if (empty($valorStr)) return null;
    // Remove R$, espaços e pontos de milhar
    $limpo = preg_replace('/[^\d,.]/', '', (string)$valorStr);
    // Trata vírgula decimal
    if (strpos($limpo, ',') !== false) {
        $limpo = str_replace('.', '', $limpo);
        $limpo = str_replace(',', '.', $limpo);
    }
    return is_numeric($limpo) ? (float)$limpo : null;
}

function validarFormulario(array $dados): array {
    $erros = [];

    // 1. nome_fornecedor
    $nome = trim($dados['nome_fornecedor'] ?? '');
    if (empty($nome)) {
        $erros['nome_fornecedor'] = 'O nome do fornecedor é obrigatório.';
    }

    // 2. email_fornecedor
    $email = trim($dados['email_fornecedor'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email_fornecedor'] = 'Informe um e-mail válido.';
    }

    // 3. categoria_produto
    $categoria = $dados['categoria_produto'] ?? '';
    if (!in_array($categoria, CATEGORIAS_PERMITIDAS, true)) {
        $erros['categoria_produto'] = 'Selecione uma categoria válida.';
    }

    // 4. descricao_item (mínimo 10 caracteres)
    $descricao = trim($dados['descricao_item'] ?? '');
    if (strlen($descricao) < 10) {
        $erros['descricao_item'] = 'A descrição deve ter no mínimo 10 caracteres.';
    }

    // 5. valor_cotacao (R$ ou apenas números)
    $valor = converterParaFloat($dados['valor_cotacao'] ?? '');
    if ($valor === null || $valor <= 0) {
        $erros['valor_cotacao'] = 'Informe um valor numérico positivo em R$.';
    }

    // 6. prazo_entrega_dias (entre 1 e 60 dias)
    $prazo = filter_var($dados['prazo_entrega_dias'] ?? '', FILTER_VALIDATE_INT);
    if ($prazo === false || $prazo < 1 || $prazo > 60) {
        $erros['prazo_entrega_dias'] = 'O prazo deve estar entre 1 e 60 dias.';
    }

    // 7. condicoes_pagamento
    $condicao = $dados['condicoes_pagamento'] ?? '';
    if (!in_array($condicao, CONDICOES_PAGAMENTO, true)) {
        $erros['condicoes_pagamento'] = 'Selecione uma condição de pagamento válida.';
    }

    return $erros;
}


$erros = [];
$mensagemSucesso = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erros = validarFormulario($_POST);

    if (empty($erros)) {
        $valorFloat = converterParaFloat($_POST['valor_cotacao']);
        
        $novaCotacao = [
            'id'            => count($cotacoesAbertas) + 1,
            'fornecedor'    => htmlspecialchars(trim($_POST['nome_fornecedor']), ENT_QUOTES, 'UTF-8'),
            'email'         => htmlspecialchars(trim($_POST['email_fornecedor']), ENT_QUOTES, 'UTF-8'),
            'categoria'     => htmlspecialchars(trim($_POST['categoria_produto']), ENT_QUOTES, 'UTF-8'),
            'descricao'     => htmlspecialchars(trim($_POST['descricao_item']), ENT_QUOTES, 'UTF-8'),
            'valor'         => $valorFloat,
            'prazo'         => (int)$_POST['prazo_entrega_dias'],
            'condicao'      => htmlspecialchars(trim($_POST['condicoes_pagamento']), ENT_QUOTES, 'UTF-8'),
            'data_abertura' => date('Y-m-d')
        ];

        // Insere a nova cotação no início da lista
        array_unshift($cotacoesAbertas, $novaCotacao);
        $mensagemSucesso = "Cotação de " . $novaCotacao['fornecedor'] . " enviada com sucesso!";

        // Limpa os dados de POST para resetar o formulário
        $_POST = [];
    }
}


$filtroFornecedor = trim($_GET['nome_fornecedor'] ?? '');
$filtroValorMax   = converterParaFloat($_GET['valor_maximo'] ?? '');

// Aplicar Filtros no Array
if ($filtroFornecedor !== '' || $filtroValorMax !== null) {
    $cotacoesAbertas = array_filter($cotacoesAbertas, function($c) use ($filtroFornecedor, $filtroValorMax) {
        if ($filtroFornecedor !== '' && stripos($c['fornecedor'], $filtroFornecedor) === false) {
            return false;
        }
        if ($filtroValorMax !== null && $c['valor'] > $filtroValorMax) {
            return false;
        }
        return true;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificação Técnica - Cotações</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #f5f6fa; color: #2f3640; margin: 0; padding: 20px; }
        .container { max-width: 950px; margin: 0 auto; }
        .card { background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 25px; }
        h1 { font-size: 1.6rem; color: #2c3e50; margin-top: 0; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px; }
        h2 { font-size: 1.2rem; color: #2980b9; margin-top: 0; margin-bottom: 15px; }
        
        /* Grid Layout */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; }
        @media (max-width: 768px) { .grid-2, .grid-3 { grid-template-columns: 1fr; } }

        /* Form Components */
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        .form-group label { font-weight: bold; font-size: 0.9rem; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea {
            padding: 10px; border: 1px solid #dcdde1; border-radius: 4px; font-size: 0.95rem;
        }
        .form-group textarea { min-height: 80px; resize: vertical; }
        
        /* Table */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f1f2f6; }
        th { background-color: #34495e; color: #fff; font-size: 0.9rem; }
        tr:hover { background-color: #f8f9fa; }
        
        /* Buttons & Badges */
        .btn { padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #2980b9; color: #fff; }
        .btn-primary:hover { background: #3498db; }
        .btn-secondary { background: #7f8c8d; color: #fff; margin-left: 5px; }
        .btn-block { width: 100%; font-size: 1rem; }
        .badge { background: #eccc68; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
        
        /* Alerts & Errors */
        .error-text { color: #e74c3c; font-size: 0.82rem; margin-top: 4px; }
        .alert { padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h1>Especificação Técnica Completa</h1>

    <!-- SEÇÃO A: FILTRO DE COTAÇÕES (GET) -->
    <div class="card">
        <h2>1️⃣ Seção A: Filtro de Cotações (GET)</h2>
        
        <form method="GET" action="supplychain.php">
            <div class="grid-3" style="align-items: flex-end;">
                <div class="form-group">
                    <label for="nome_fornecedor_filter">Buscar por Fornecedor:</label>
                    <input type="text" id="nome_fornecedor_filter" name="nome_fornecedor" 
                           value="<?= htmlspecialchars($_GET['nome_fornecedor'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                           placeholder="Ex: Eletro">
                </div>
                
                <div class="form-group">
                    <label for="valor_maximo_filter">Valor Máximo (R$):</label>
                    <input type="text" id="valor_maximo_filter" name="valor_maximo" 
                           value="<?= htmlspecialchars($_GET['valor_maximo'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                           placeholder="Ex: 3000">
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="supplychain.php" class="btn btn-secondary">Limpar</a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Tabela de Cotações -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fornecedor</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Condição</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($cotacoesAbertas)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #7f8c8d;">Nenhuma cotação encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cotacoesAbertas as $cotacao): ?>
                        <tr>
                            <td>#<?= $cotacao['id'] ?></td>
                            <td><strong><?= $cotacao['fornecedor'] ?></strong><br><small><?= $cotacao['email'] ?></small></td>
                            <td><span class="badge"><?= $cotacao['categoria'] ?></span></td>
                            <td><?= $cotacao['descricao'] ?></td>
                            <td>R$ <?= number_format($cotacao['valor'], 2, ',', '.') ?></td>
                            <td><?= $cotacao['condicao'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- SEÇÃO B: FORMULÁRIO DE NOVA COTAÇÃO (POST) -->
    <div class="card">
        <h2>2️⃣ Seção B: Formulário de Nova Cotação (POST)</h2>

        <?php if ($mensagemSucesso): ?>
            <div class="alert alert-success"><?= $mensagemSucesso ?></div>
        <?php endif; ?>

        <?php if (!empty($erros)): ?>
            <div class="alert alert-danger">Existem erros de preenchimento. Por favor, verifique os campos em vermelho.</div>
        <?php endif; ?>

        <form method="POST" action="supplychain.php">
            <div class="grid-2">
                <!-- nome_fornecedor (text) -->
                <div class="form-group">
                    <label for="nome_fornecedor">Nome do Fornecedor *</label>
                    <input type="text" id="nome_fornecedor" name="nome_fornecedor" 
                           value="<?= htmlspecialchars($_POST['nome_fornecedor'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <?php if (isset($erros['nome_fornecedor'])): ?>
                        <span class="error-text"><?= $erros['nome_fornecedor'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- email_fornecedor (text) -->
                <div class="form-group">
                    <label for="email_fornecedor">E-mail Corporativo *</label>
                    <input type="text" id="email_fornecedor" name="email_fornecedor" 
                           value="<?= htmlspecialchars($_POST['email_fornecedor'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <?php if (isset($erros['email_fornecedor'])): ?>
                        <span class="error-text"><?= $erros['email_fornecedor'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid-3">
                <!-- categoria_produto (select) -->
                <div class="form-group">
                    <label for="categoria_produto">Categoria *</label>
                    <select id="categoria_produto" name="categoria_produto">
                        <option value="">Selecione...</option>
                        <?php foreach (CATEGORIAS_PERMITIDAS as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($_POST['categoria_produto'] ?? '') === $cat ? 'selected' : '' ?>>
                                <?= $cat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($erros['categoria_produto'])): ?>
                        <span class="error-text"><?= $erros['categoria_produto'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- valor_cotacao (text) -->
                <div class="form-group">
                    <label for="valor_cotacao">Valor da Cotação (R$) *</label>
                    <input type="text" id="valor_cotacao" name="valor_cotacao" placeholder="Ex: 1500,00 ou R$ 1.500,00"
                           value="<?= htmlspecialchars($_POST['valor_cotacao'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <?php if (isset($erros['valor_cotacao'])): ?>
                        <span class="error-text"><?= $erros['valor_cotacao'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- prazo_entrega_dias (number) -->
                <div class="form-group">
                    <label for="prazo_entrega_dias">Prazo de Entrega (1 a 60 dias) *</label>
                    <input type="number" id="prazo_entrega_dias" name="prazo_entrega_dias" placeholder="Ex: 15"
                           value="<?= htmlspecialchars($_POST['prazo_entrega_dias'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <?php if (isset($erros['prazo_entrega_dias'])): ?>
                        <span class="error-text"><?= $erros['prazo_entrega_dias'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- condicoes_pagamento (select) -->
            <div class="form-group">
                <label for="condicoes_pagamento">Condição de Pagamento *</label>
                <select id="condicoes_pagamento" name="condicoes_pagamento">
                    <option value="">Selecione...</option>
                    <?php foreach (CONDICOES_PAGAMENTO as $cond): ?>
                        <option value="<?= $cond ?>" <?= ($_POST['condicoes_pagamento'] ?? '') === $cond ? 'selected' : '' ?>>
                            <?= $cond ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($erros['condicoes_pagamento'])): ?>
                    <span class="error-text"><?= $erros['condicoes_pagamento'] ?></span>
                <?php endif; ?>
            </div>

            <!-- descricao_item (textarea) -->
            <div class="form-group">
                <label for="descricao_item">Descrição do Item (Mínimo 10 caracteres) *</label>
                <textarea id="descricao_item" name="descricao_item"><?= htmlspecialchars($_POST['descricao_item'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                <?php if (isset($erros['descricao_item'])): ?>
                    <span class="error-text"><?= $erros['descricao_item'] ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Cadastrar Cotação (POST)</button>
        </form>
    </div>
</div>

</body>
</html>