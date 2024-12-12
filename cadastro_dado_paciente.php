<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NutriCare - Dados do Paciente</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <h1>Cadastro dos Dados do Paciente</h1>
            <form action="cadastro_dados_paciente_processar.php" method="POST">
                <input type="number" name="altura" step="0.01" placeholder="Altura (em metros)" required>
                <input type="number" name="peso" step="0.01" placeholder="Peso (em kg)" required>
                <textarea name="objetivo_nutricional" placeholder="Objetivo nutricional" required></textarea>
                <textarea name="alergias" placeholder="Alergias"></textarea>
                <textarea name="restricoes_alimentares" placeholder="Restrições alimentares"></textarea>
                <input type="number" name="cintura" step="0.01" placeholder="Cintura (em cm)">
                <input type="number" name="quadril" step="0.01" placeholder="Quadril (em cm)">
                <input type="number" name="coxa" step="0.01" placeholder="Coxa (em cm)">
                <input type="number" name="braco" step="0.01" placeholder="Braço (em cm)">
                <button type="submit">Salvar Dados</button>
            </form>
        </div>
    </div>
</body>
</html>
