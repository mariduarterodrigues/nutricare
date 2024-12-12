<?php
require_once 'inicia_sessao.php';
require_once 'db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $objetivo_nutricional = $_POST['objetivo_nutricional'];
    $alergias = $_POST['alergias'];
    $restricoes_alimentares = $_POST['restricoes_alimentares'];
    $cintura = $_POST['cintura'];
    $quadril = $_POST['quadril'];
    $coxa = $_POST['coxa'];
    $braco = $_POST['braco'];

    $sql = "INSERT INTO dado_paciente (id_usuario, altura, peso, objetivo_nutricional, alergias, restricoes_alimentares, cintura, quadril, coxa, braco) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('iddssssddd', $id_usuario, $altura, $peso, $objetivo_nutricional, $alergias, $restricoes_alimentares, $cintura, $quadril, $coxa, $braco);

    if ($stmt->execute()) {
        header("Location: gerar_dieta.php");
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
