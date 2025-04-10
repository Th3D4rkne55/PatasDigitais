<!--
Este script atualiza os dados do perfil do usuário logado.

Ele começa verificando se há uma sessão ativa com o ID do usuário.
Se não houver, redireciona para a tela de login com um alerta.

Se estiver logado, recebe os dados do formulário (nome, e-mail, telefone e senha),
criptografa a nova senha e atualiza os dados no banco de dados.

Ao final, se a atualização for bem-sucedida, atualiza o nome do usuário na sessão
e redireciona para a página inicial com uma mensagem de sucesso.
-->


<?php
session_start();
require 'conecta.php';

if (!isset($_SESSION['id_usuario'])) {
  echo "<script>alert('Acesso negado!'); window.location.href='../login.html';</script>";
  exit;
}

$id = $_SESSION['id_usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, senha = ? WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssi", $nome, $email, $telefone, $senha, $id);

if ($stmt->execute()) {

  $_SESSION['usuario'] = $nome;

  echo "<script>
    alert('Perfil atualizado com sucesso!');
    window.location.href = '../index.php';
  </script>";
} else {
  echo "<script>alert('Erro ao atualizar perfil!'); history.back();</script>";
}
?>
