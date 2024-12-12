<?php
$servidor = "localhost";
$usuario_db = "root";
$senha_db = "";
$banco = "nutricare";

$conexao = new mysqli($servidor, $usuario_db, $senha_db, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
} 
?>