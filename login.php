<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="bg-dark">

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
    <div class="d-flex align-items-center justify-content-center px-3" style="height: 90%;">
        <div class="card p-4 shadow bg-dark text-light w-100" style="max-width: 400px;">
            <h4 class="text-center mb-3">Login</h4>
            <form action="testLogin.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="text-center mt-3">
                <small>Ainda não tem conta? <a href="cadastro.php" class="text-info">Cadastre-se</a></small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
