<?php
require_once 'inicia_sessao.php';
require_once 'db_conexao.php';

$query = "SELECT data_consulta, horario FROM agendamento WHERE id_usuario = ? AND data_consulta >= CURDATE() ORDER BY data_consulta, horario";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$agendamentos = [];
while ($row = $result->fetch_assoc()) {
    $agendamentos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Meus Agendamentos</title>
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
            <h1>Meus Agendamentos</h1>
            <?php if (count($agendamentos) > 0): ?>
                <div class="table-container">
                    <table class="table">
                        <thead class="table-header">
                            <tr>
                                <th>Data</th>
                                <th>Horário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agendamentos as $agendamento): ?>
                                <tr class="table-row">
                                    <td><?= date("d/m/Y", strtotime($agendamento['data_consulta'])) ?></td>
                                    <td><?= $agendamento['horario'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="empty-message">Você não tem nenhum agendamento futuro.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
