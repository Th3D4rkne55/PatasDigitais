<!--
Este script verifica o código de recuperação enviado pelo usuário.

1. Inicia a sessão.
2. Verifica se o código foi enviado via POST.
3. Compara o código digitado com o código salvo na sessão.
4. Se estiver correto:
   - Conecta ao banco de dados.
   - Busca os dados do usuário.
   - Cria a sessão de login.
   - Limpa os dados da recuperação.
   - Redireciona o usuário para a página de edição de perfil.
5. Se o código estiver incorreto ou a sessão estiver inválida, exibe mensagens de alerta e retorna.
-->


<?php
session_start();

$codigoUsuario = trim($_POST['codigo']);
$codigoCorreto = $_SESSION['codigo_recuperacao'] ?? null;
$idUsuario = $_SESSION['id_usuario_recuperacao'] ?? null;

if ($codigoUsuario && $codigoUsuario == $codigoCorreto && $idUsuario) {
    
    require_once 'conecta.php';
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();


    $_SESSION['usuario'] = $usuario['nome'];
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['tipo'] = $usuario['tipo_usuario'];


    header('Location: ../editarPerfil.php');
    exit;
} else {
    echo "<script>alert('Código incorreto ou sessão expirada!'); history.back();</script>";
}



if (!isset($_POST['codigo'])) {
    echo "<script>alert('Código não informado.'); window.history.back();</script>";
    exit;
}

$codigoDigitado = trim($_POST['codigo']);


if (!isset($_SESSION['codigo_recuperacao']) || !isset($_SESSION['id_usuario_recuperacao'])) {
    echo "<script>alert('Sessão expirada ou inválida. Tente novamente.'); window.location.href='../login.html';</script>";
    exit;
}

$codigoCorreto = $_SESSION['codigo_recuperacao'];

if ($codigoDigitado === $codigoCorreto) {

    $_SESSION['id_usuario'] = $_SESSION['id_usuario_recuperacao'];


    unset($_SESSION['codigo_recuperacao']);
    unset($_SESSION['id_usuario_recuperacao']);

    echo "<script>alert('Código verificado com sucesso!'); window.location.href='../editarPerfil.php';</script>";
} else {
    echo "<script>alert('Código incorreto. Tente novamente.'); window.history.back();</script>";
}
