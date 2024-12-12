<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NutriCare - Cadastro do Paciente</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <h1>Cadastro do Paciente</h1>
            <form action="cadastro_usuario_processar.php" method="POST">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required>
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
