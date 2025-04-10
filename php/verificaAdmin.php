<?php
// Verifica se o usuário está logado e se é do tipo 'admin'
// Caso contrário, exibe alerta e redireciona para a página inicial
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
  echo "<script>alert('Acesso restrito! Apenas administradores.'); window.location.href='../index.php';</script>";
  exit;
}
?>
