<!--
Este script trata a recuperação de senha.
Verifica se o e-mail existe no banco, gera um código aleatório de 6 dígitos,
salva os dados em sessão e envia o código para o e-mail do usuário usando PHPMailer.
-->


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/conecta.php';

session_start();

$email = $_POST['email'];

$sql = "SELECT id, nome FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($usuario = $result->fetch_assoc()) {
    $codigo = rand(100000, 999999);

    $_SESSION['codigo_recuperacao'] = $codigo;
    $_SESSION['email_recuperacao'] = $email;
    $_SESSION['id_usuario_recuperacao'] = $usuario['id'];

    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contato.patasdigitais@gmail.com';
        $mail->Password   = 'qhws jbqv xgwe wyga';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('contato.patasdigitais@gmail.com', 'Patas Digitais');
        $mail->addAddress($email, $usuario['nome']);

        $mail->isHTML(true);
        $mail->Subject = 'Código de Recuperação - Patas Digitais';
        $mail->Body    = "
            <p>Olá, <strong>{$usuario['nome']}</strong>!</p>
            <p>Seu código de recuperação de senha é:</p>
            <h2 style='color: #2A9D8F;'>$codigo</h2>
            <p>Insira este código no site para redefinir sua senha.</p>
        ";

        $mail->send();
        echo "<script>alert('Um código foi enviado ao seu e-mail!'); window.location.href='../verificarCodigo.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erro ao enviar o e-mail: {$mail->ErrorInfo}'); history.back();</script>";
    }
} else {
    echo "<script>alert('E-mail não encontrado!'); history.back();</script>";
}
