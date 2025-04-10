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

function gerarCodigoAnimal($conexao) {
  return 'AN' . strtoupper(substr(md5(time() . rand()), 0, 8));
}


$codigo = gerarCodigoAnimal($conexao);
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$porte = $_POST['porte'];
$doencas = $_POST['doencas'];
$instituicao = $_POST['instituicao'];
$status = $_POST['status'];


$imagePaths = [];

if (isset($_FILES['imagens']) && !empty($_FILES['imagens']['name'][0])) {
  $totalFiles = count($_FILES['imagens']['name']);
  $uploadDir = '../images/animais/'; 

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  for ($i = 0; $i < $totalFiles; $i++) {
    $fileTmpPath = $_FILES['imagens']['tmp_name'][$i];
    $fileName = $_FILES['imagens']['name'][$i];
    $newFileName = uniqid() . '_' . basename($fileName);
    $destPath = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
      
      $imagePaths[] = "images/animais/" . $newFileName;
    }
  }
}

$sql = "INSERT INTO animais (codigo, nome, idade, porte, doencas, instituicao, status, imagem)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$imagensStr = implode(',', $imagePaths);
$stmt->bind_param("ssssssss", $codigo, $nome, $idade, $porte, $doencas, $instituicao, $status, $imagensStr);
$stmt->execute();


echo "<script>
  alert('Animal cadastrado com sucesso! Código: $codigo');
  window.location.href = '../index.php';
</script>";
?>
