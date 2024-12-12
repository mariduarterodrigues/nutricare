<?php
require_once 'inicia_sessao.php';
require_once 'db_conexao.php';

$sql = "SELECT dp.descricao 
        FROM dieta_usuario du
        JOIN dieta_padrao dp ON du.id_dieta_padrao = dp.id
        WHERE du.id_usuario = ? LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$dieta = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NutriCare - Área do Cliente</title>
</head>
<body>
    <div class="navbar">
        <a href="cliente_area.php" class="logo">NutriCare</a>
        <div class="nav-links">
            <a href="agendar_consulta.php">Agendar Consulta</a>
            <a href="historico_consultas.php">Histórico de Consultas</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    
    <div class="content">
        <div class="hero">
            <h1>Bem-vindo à Área do Cliente!</h1>
            <p>Aqui você pode explorar todos os recursos disponíveis no portal NutriCare.</p>
        </div>
        
        <?php if ($dieta): ?>
        <div class="hero">
            <h1>Sua Dieta</h1>
            <p>Você está com a dieta: <strong><?= $dieta['descricao'] ?></strong></p>
        </div>
        <?php else: ?>
        <div class="hero">
            <h1>Ainda não temos uma dieta para você.</h1>
            <p>Preencha seus dados e espere pela geração da dieta personalizada.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
