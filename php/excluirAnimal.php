<!--
Este script exclui um animal do banco de dados.

Se houver imagem associada, ela também é removida do servidor.
Em seguida, o registro é deletado do banco e o usuário é redirecionado.
-->


<?php
require 'conecta.php';

$id = $_POST['id'];
$imagem = $_POST['imagem'];

if ($imagem && file_exists("../" . $imagem)) {
    unlink("../" . $imagem);
}

$sql = "DELETE FROM animais WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo "<script>alert('Animal excluído com sucesso!'); window.location.href='../index.php';</script>";
?>
