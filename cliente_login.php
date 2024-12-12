<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NutriCare - Login do Cliente</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <h1>Login - Cliente</h1>
            <form action="login.php" method="post">
                <input type="hidden" name="tipo_usuario" value="cliente">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>

                <button type="submit">Entrar</button>
            </form>
            <p>Não tem uma conta? <a href="cadastro_usuario.php">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>
