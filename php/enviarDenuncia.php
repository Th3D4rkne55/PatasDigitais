<!--
Este script recebe os dados do formulário de denúncia, gera um protocolo único,
salva as informações no banco de dados, anexa um arquivo (se houver),
e envia um e-mail com os detalhes da denúncia usando o PHPMailer.
-->


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/Exception.php';
require 'conecta.php'; 

function gerarProtocolo() {
    return strtoupper(substr(md5(time() . rand()), 0, 8));
}

$protocolo = gerarProtocolo();
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$endereco = $_POST['endereco'];
$descricao = $_POST['descricao'];
$nome_arquivo = null;


if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['arquivo']['tmp_name'];
    $nome_arquivo = $_FILES['arquivo']['name'];
    $destino = "../anexos/" . basename($nome_arquivo);

    if (!is_dir("../anexos")) {
        mkdir("../anexos", 0777, true);
    }

    move_uploaded_file($tmp_name, $destino);
}


$sql = "INSERT INTO denuncias (protocolo, cidade, estado, endereco, descricao, anexo)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssss", $protocolo, $cidade, $estado, $endereco, $descricao, $nome_arquivo);
$stmt->execute();


$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contato.patasdigitais@gmail.com'; 
    $mail->Password   = 'qhws jbqv xgwe wyga'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('contato.patasdigitais@gmail.com', 'Patas Digitais');
    $mail->addAddress('contato.patasdigitais@gmail.com');

    if ($nome_arquivo) {
        $mail->addAttachment("../anexos/$nome_arquivo", $nome_arquivo);
    }

    $mensagem = "Protocolo: $protocolo<br>";
    $mensagem .= "Cidade: $cidade<br>";
    $mensagem .= "Estado: $estado<br>";
    $mensagem .= "Endereço: $endereco<br>";
    $mensagem .= "Descrição:<br>$descricao<br>";

    $mail->isHTML(true);
    $mail->Subject = "Nova denúncia - Protocolo $protocolo";
    $mail->Body    = $mensagem;

    $mail->send();
    echo "<script>alert('Denúncia enviada e salva com sucesso! Protocolo: $protocolo'); window.location.href='../index.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Erro ao enviar o e-mail: {$mail->ErrorInfo}'); history.back();</script>";
}
?>
