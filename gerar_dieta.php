<?php
require_once 'inicia_sessao.php';
require_once 'db_conexao.php';

// Recuperando peso do paciente
$sql = "SELECT peso FROM dado_paciente WHERE id_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$peso = $resultado->fetch_assoc()['peso'];

if (!$peso) {
    echo "Erro: Peso não encontrado para o usuário.";
    exit();
}

// Selecionando a dieta com base no peso
$sql = "SELECT id FROM dieta_padrao WHERE ? BETWEEN peso_min AND peso_max LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('d', $peso);
$stmt->execute();
$resultado = $stmt->get_result();

if ($dieta = $resultado->fetch_assoc()) {
    // Inserindo a dieta do paciente
    $sql = "INSERT INTO dieta_usuario (id_usuario, id_dieta_padrao) 
            VALUES ((SELECT id FROM dado_paciente WHERE id_usuario = ?), ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ii', $id_usuario, $dieta['id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Dieta inserida com sucesso!";
    } else {
        echo "Erro ao inserir a dieta na tabela dieta_usuario.";
    }
} else {
    echo "Nenhuma dieta encontrada para o peso fornecido.";
}

header("Location: cliente_area.php");
exit();
?>
