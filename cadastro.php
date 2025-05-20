
<?php
    include_once('config.php');
    $mostrarModal = false;
    $erro = "";

    // Verifica se todos os campos foram enviados
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome     = mysqli_real_escape_string($conexao, $_POST["nome"]);
        $email    = mysqli_real_escape_string($conexao, $_POST["email"]);
        $senha    = mysqli_real_escape_string($conexao, $_POST["senha"]);
        $endereco = mysqli_real_escape_string($conexao, $_POST["endereco"]);
        $sexo     = mysqli_real_escape_string($conexao, $_POST["sexo"]);


        $sql = "INSERT INTO usuarios (nome, email, senha, endereco, sexo) 
                VALUES ('$nome', '$email', '$senha', '$endereco', '$sexo')";

        $result = mysqli_query($conexao, $sql);

         if ($result) {
            $mostrarModal = true;
        } else {
            $erro = "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="bg-dark text-light">

    <?php if ($erro): ?>
        <div class="alert alert-danger text-center"><?php echo $erro; ?></div>
    <?php endif; ?>

    <!-- Modal de Sucesso -->
    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered "> <!-- Centralizado -->
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-light" id="modalLabel">Sucesso</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body text-light">
                    Usuário cadastrado com sucesso!
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Ir para o Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand text-light">Finans</a>
            <div class="navbar-brand">
                <a class="nav-link btn-close btn-close-white" href="inicio.html"></a>
            </div>
        </div>
    </nav>

    <!-- Conteúdo centralizado -->
    <div class="d-flex align-items-center justify-content-center px-3" style="min-height: 90vh;">
        <div class="card p-4 shadow bg-dark text-light w-100" style="max-width: 500px;">
            <h4 class="text-center mb-3">Cadastro</h4>
            <form action="cadastro.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmar Senha:</label>
                    <input type="password" id="confirmar" name="confirmar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <input name="submit" type="submit" id="submit" class="btn btn-success w-100" value="Cadastrar">
                <div class="text-center mt-3">
                    <small>Já tem conta? <a href="./login.php" class="text-decoration-none text-info">Login</a></small>
                </div>
            </form>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($mostrarModal): ?>
    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalSucesso'));
        window.onload = function() {
            modal.show();
        }
    </script>
    <?php endif; ?>

</body>
</html>
