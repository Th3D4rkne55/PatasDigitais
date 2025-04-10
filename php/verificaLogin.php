
<?php
// Verifica se o usuário está logado
// Se não estiver, redireciona para a página de login
session_start();

if (!isset($_SESSION['usuario'])) {
  echo "<script>
    alert('Você precisa estar logado para acessar esta página.');
    window.location.href = '/PatasDigitais/login.html';
  </script>";
  exit;
}
?>
