<!--
Este script envia um e-mail com os dados do formulário da página "Quem Somos".
Utiliza PHPMailer para configurar o envio via SMTP do Gmail.
Os campos enviados são: nome, e-mail, telefone e mensagem.
-->


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';


$nome     = $_POST['nome'];
$email    = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];


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

    $mail->isHTML(true);
    $mail->Subject = 'Mensagem de Contato - Quem Somos';
    $mail->Body    = "
      <strong>Nome:</strong> $nome <br>
      <strong>E-mail:</strong> $email <br>
      <strong>Telefone:</strong> $telefone <br><br>
      <strong>Mensagem:</strong><br> $mensagem
    ";

    $mail->send();
    echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = '../index.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Erro ao enviar: {$mail->ErrorInfo}'); history.back();</script>";
}
?>
