<!--
Este script realiza o login do usuário.

Verifica o e-mail e a senha informados com os dados do banco.
Se estiverem corretos, inicia a sessão e redireciona para a página inicial.
Caso contrário, exibe uma mensagem de erro.
-->


<?php
require 'conecta.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    session_start();
    $_SESSION['usuario'] = $usuario['nome'];
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['tipo'] = $usuario['tipo_usuario'];
    echo "<script>alert('Login realizado com sucesso!'); window.location.href='../index.php';</script>";
} else {
    echo "<script>alert('E-mail ou senha incorretos.'); history.back();</script>";
}
?>
