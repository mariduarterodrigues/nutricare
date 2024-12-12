<?php
require_once 'db_conexao.php';

// Obtém os dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$tipo_usuario = $_POST['tipo_usuario'];

// Consulta para verificar as credenciais
$sql = "SELECT * FROM usuario WHERE usuario = ? AND senha = ? AND tipo_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sss", $usuario, $senha, $tipo_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuário encontrado
    $usuario_logado = $resultado->fetch_assoc();
    session_start();
    $_SESSION['id_usuario'] = $usuario_logado['id'];
    $_SESSION['nome'] = $usuario_logado['nome'];
    $_SESSION['tipo_usuario'] = $usuario_logado['tipo_usuario'];

    if ($tipo_usuario === 'admin') {
        header("Location: admin_area.php");
    } else {
        header("Location: cliente_area.php");
    }
} else {
    // Credenciais inválidas
    echo "<script>alert('Usuário ou senha incorretos!'); window.location.href = 'index.php';</script>";
}

$stmt->close();
$conexao->close();
?>
