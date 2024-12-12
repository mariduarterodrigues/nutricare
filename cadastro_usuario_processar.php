<?php
require_once 'db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $data_nascimento = $_POST['data_nascimento'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql_check = "SELECT * FROM usuario WHERE usuario = ?";
    $stmt_check = $conexao->prepare($sql_check);
    $stmt_check->bind_param('s', $usuario);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Usuário já existe!'); window.location.href = 'cadastro_usuario.php';</script>";
    } else {
        $sql = "INSERT INTO usuario (nome, sobrenome, data_nascimento, usuario, senha, tipo_usuario) VALUES (?, ?, ?, ?, ?, 'cliente')";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('sssss', $nome, $sobrenome, $data_nascimento, $usuario, $senha);

        if ($stmt->execute()) {
            session_start();
            $_SESSION['id_usuario'] = $conexao->insert_id;
            header("Location: cadastro_dado_paciente.php");
            exit; 
        } else {
            echo "<script>alert('Erro ao cadastrar: " . addslashes($stmt->error) . "'); window.location.href = 'cadastro_usuario.php';</script>";
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conexao->close();
}
?>
