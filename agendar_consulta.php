<?php
require_once 'inicia_sessao.php';
require_once 'db_conexao.php';

$agendamentos = [];
$query = "SELECT data_consulta, horario FROM agendamento WHERE data_consulta >= CURDATE()";
$result = mysqli_query($conexao, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $agendamentos[] = $row;
}

function horarioDisponivel($data, $hora, $agendamentos) {
    foreach ($agendamentos as $agendamento) {
        if ($agendamento['data_consulta'] == $data && $agendamento['horario'] == $hora) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['data_consulta'], $_POST['horario']) && !empty($_POST['horario'])) {
        $data = $_POST['data_consulta'];
        $horario = $_POST['horario'];

        if (horarioDisponivel($data, $horario, $agendamentos)) {
            $query_check = "SELECT * FROM agendamento WHERE data_consulta = ? AND horario = ?";
            $stmt_check = $conexao->prepare($query_check);
            $stmt_check->bind_param("ss", $data, $horario);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            
            if ($result_check->num_rows > 0) {
                $erro = "Este horário já está ocupado. Tente outro horário.";
            } else {
                $query = "INSERT INTO agendamento (id_usuario, data_consulta, horario) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($query);
                $stmt->bind_param("iss", $id_usuario, $data, $horario);
                $stmt->execute();
                header("Location: historico_consultas.php");
                exit();
            }
        } else {
            $erro = "Horário indisponível. Tente outro horário.";
        }
    } else {
        $erro = "Por favor, selecione uma data e um horário válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendar Consulta</title>
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

    <div class="agendamento-container content">
        <div class="hero">
            <h1>Agendar Consulta</h1>

            <?php if (isset($erro)): ?>
                <p style="color: red;"><?= $erro ?></p>
            <?php endif; ?>

            <form method="POST">
                <label for="data_consulta">Selecione a Data:</label>
                <input type="date" id="data_consulta" name="data_consulta" required 
                    min="<?= date('Y-m-d', strtotime('+1 day')) ?>" 
                    value="<?= $_POST['data_consulta'] ?? '' ?>" 
                    onchange="this.form.submit()">

                <label for="horario">Selecione o Horário:</label>
                <select name="horario" id="horario" required>
                    <option value="">Selecione um horário</option>
                    <?php
                    $data_selecionada = $_POST['data_consulta'] ?? null;

                    if ($data_selecionada) {
                        for ($hora = 8; $hora <= 17; $hora++) {
                            $hora_formatada = str_pad($hora, 2, '0', STR_PAD_LEFT) . ":00";
                            $disabled = !horarioDisponivel($data_selecionada, $hora_formatada, $agendamentos);
                            echo "<option value='$hora_formatada' " . ($disabled ? 'disabled' : '') . ">$hora_formatada</option>";
                        }
                    }
                    ?>
                </select>

                <button type="submit" class="button">Agendar</button>
            </form>
        </div>
    </div>
</body>
</html>
