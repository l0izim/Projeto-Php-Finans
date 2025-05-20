<?php
    session_start();
    //print_r($_SESSION);
    
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION ['email']);
        unset($_SESSION ['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Login/setLogin.php');
    exit;
}
if (!isset($_SESSION['transacoes'])) {
    $_SESSION['transacoes'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        $_SESSION['transacoes'][] = [
            'descricao' => $_POST['descricao'],
            'valor' => (float)$_POST['valor'],
            'tipo' => $_POST['tipo']
        ];
    }
    if (isset($_POST['remover'])) {
        unset($_SESSION['transacoes'][$_POST['indice']]);
        $_SESSION['transacoes'] = array_values($_SESSION['transacoes']);
    }
}

$entradas = 0;
$saidas = 0;
foreach ($_SESSION['transacoes'] as $t) {
    if ($t['tipo'] === 'entrada') {
        $entradas += $t['valor'];
    } else {
        $saidas += $t['valor'];
    }
}
$saldo = $entradas - $saidas;
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg p-2 shadow">
    <div class="container">
        <a class="navbar-brand text-light h2 mb-0">Finans</a>
        <span class="navbar-text text-light me-auto">Sessão logada: <?= htmlspecialchars($logado) ?></span>
        <a href="sair.php" class="btn btn-outline-danger">Sair</a>
    </div>
</nav>

<!-- Conteúdo principal -->
<div class="container mt-4">
    <h1 class="text-center mb-4 text-light">Dashboard</h1>

    <!-- Resumo financeiro -->
    <div class="row text-center mb-4 g-3">
        <div class="col-md-4">
            <div class="card bg-success p-3 shadow text-light">
                <h5>Entradas</h5>
                <p>R$ <?= number_format($entradas, 2, ',', '.') ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger p-3 shadow text-light">
                <h5>Saídas</h5>
                <p>R$ <?= number_format($saidas, 2, ',', '.') ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border border-light p-3 shadow text-light">
                <h5>Saldo</h5>
                <p>R$ <?= number_format($saldo, 2, ',', '.') ?></p>
            </div>
        </div>
    </div>

    <!-- Formulário de transações -->
    <form method="POST" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="descricao" class="form-control" placeholder="Descrição" required>
        </div>
        <div class="col-md-3">
            <input type="number" step="0.01" name="valor" class="form-control" placeholder="Valor" required>
        </div>
        <div class="col-md-3">
            <select name="tipo" class="form-select" required>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" name="adicionar" class="btn btn-success w-100">Adicionar</button>
        </div>
    </form>

    <!-- Tabela de transações -->
    <div class="table-responsive shadow">
        <table class="table table-dark table-striped mb-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['transacoes'])): ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma transação registrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['transacoes'] as $i => $t): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($t['descricao']) ?></td>
                            <td>R$ <?= number_format($t['valor'], 2, ',', '.') ?></td>
                            <td class="<?= $t['tipo'] === 'entrada' ? 'text-success' : 'text-danger' ?>">
                                <?= ucfirst($t['tipo']) ?>
                            </td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="indice" value="<?= $i ?>">
                                    <button type="submit" name="remover" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>