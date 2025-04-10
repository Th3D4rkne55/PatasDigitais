<!--
Este script realiza o cadastro de um novo usuário no sistema.

Ele se conecta ao banco de dados, recebe os dados enviados por formulário via POST,
criptografa a senha com password_hash e verifica se o e-mail já está cadastrado.

Se o e-mail ainda não existir no banco, os dados são inseridos na tabela 'usuarios'
com o tipo padrão de usuário definido como 'usuario'.

Ao final, uma mensagem de sucesso ou erro é exibida com JavaScript.
-->


<?php
require 'conecta.php';

$nome       = $_POST['nome'];
$data_nasc  = $_POST['data_nascimento'];
$telefone   = $_POST['telefone'];
$email      = $_POST['email'];
$senha      = $_POST['senha'];
$tipo       = 'usuario';


$senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

$verificaEmail = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$verificaEmail->bind_param("s", $email);
$verificaEmail->execute();
$verificaEmail->store_result();

if ($verificaEmail->num_rows > 0) {
    echo "<script>alert('Este e-mail já está cadastrado.'); history.back();</script>";
    exit;
}


$sql = "INSERT INTO usuarios (nome, data_nascimento, telefone, email, senha, tipo_usuario)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssss", $nome, $data_nasc, $telefone, $email, $senha_cripto, $tipo);

if ($stmt->execute()) {
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../login.html';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar. Tente novamente.'); history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patas Digitais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/mobile.css">
  <link rel="icon" href="./images/logo.png" />
</head>

<body>
    
</body>

</html>

