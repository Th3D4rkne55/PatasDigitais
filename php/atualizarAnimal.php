<!--
Este script atualiza as informações de um animal no banco de dados.

Recebe os dados do formulário via POST, incluindo os campos do animal e, opcionalmente, uma nova imagem.

Se uma nova imagem for enviada, ela é salva na pasta correta e substitui a anterior.
A imagem antiga é excluída, se existir.

Depois disso, os dados (incluindo o caminho da imagem) são atualizados no banco de dados.
Por fim, exibe um alerta de sucesso e redireciona para a página inicial.
-->


<?php
require 'conecta.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$porte = $_POST['porte'];
$doencas = $_POST['doencas'];
$instituicao = $_POST['instituicao'];
$imagem_atual = $_POST['imagem_atual'];
$nova_imagem = null;
$status = $_POST['status'];


if (isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['nova_imagem']['tmp_name'];
    $nome_arquivo = $_FILES['nova_imagem']['name'];
    $caminho = "../images/animais/";

    if (!is_dir($caminho)) {
        mkdir($caminho, 0777, true);
    }


    if ($imagem_atual && file_exists("../" . $imagem_atual)) {
        unlink("../" . $imagem_atual);
    }

    move_uploaded_file($tmp, $caminho . $nome_arquivo);
    $nova_imagem = "images/animais/" . basename($nome_arquivo);
} else {
    $nova_imagem = $imagem_atual;
}


$sql = "UPDATE animais SET nome=?, idade=?, porte=?, doencas=?, instituicao=?, imagem=?, status=? WHERE id=?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssssssi", $nome, $idade, $porte, $doencas, $instituicao, $nova_imagem, $status, $id);
$stmt->execute();

echo "<script>alert('Animal atualizado com sucesso!'); window.location.href='../index.php';</script>";
?>
