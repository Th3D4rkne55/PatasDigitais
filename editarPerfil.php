<!--
Página de edição de perfil do projeto Patas Digitais.

Inicia sessão e verifica se o usuário está logado com PHP.

Conecta ao banco e busca os dados do usuário autenticado.

HTML com Bootstrap, ícones, estilos personalizados.

Navbar com logo e nome do projeto.

Formulário centralizado para edição de:
- Nome, telefone, email e senha.
- Data de nascimento exibida, mas não editável.

Os dados do formulário são enviados para um script PHP que atualiza no banco.

Rodapé com créditos e links para redes sociais com ícones.

Tooltips ativados com script Bootstrap.

Visual limpo e responsivo usando Bootstrap.
-->


<?php
session_start();
require 'php/conecta.php';

if (!isset($_SESSION['id_usuario'])) {
  echo "<script>alert('Você precisa estar logado para acessar essa página.'); window.location.href='login.html';</script>";
  exit;
}

$id = $_SESSION['id_usuario'];
$sql = "SELECT nome, email, telefone, data_nascimento FROM usuarios WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/mobile.css">
  <link rel="icon" href="./images/logo.png">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
  

  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0b3954">
    <div class="container-fluid px-4 py-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="images/logo.png" alt="Logo" style="height: 45px">
        <span class="fw-bold text-white">Patas Digitais</span>
      </a>
    </div>
  </nav>

  
  <div class="container mt-5 flex-grow-1">
    <h2 class="text-center mb-4">Editar Perfil</h2>

    <form action="php/atualizarPerfil.php" method="POST" class="mx-auto" style="max-width: 500px;">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required value="<?= htmlspecialchars($usuario['nome']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" required value="<?= htmlspecialchars($usuario['telefone']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($usuario['email']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Nova Senha</label>
        <input type="password" name="senha" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Data de nascimento (não editável)</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>" disabled>
      </div>

      <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
    </form>
  </div>

  
  <footer class="text-white text-center py-3 mt-auto" style="background-color: #05283d">
    <div class="container">
      <p class="mb-1 fs-6">© Patas Digitais - Inovação e Empatia ao Alcance de um Clique</p>
      <div class="d-flex justify-content-center gap-5 mt-4">
        <a href="https://wa.me/5567992699299" class="text-white fs-4" target="_blank" data-bs-toggle="tooltip" title="WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
        <a href="https://www.instagram.com/_ericknathan_?igsh=bzhhYmQ2dGg4bG51" class="text-white fs-4" target="_blank" data-bs-toggle="tooltip" title="Instagram">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.linkedin.com/in/erick-nathan/" class="text-white fs-4" target="_blank" data-bs-toggle="tooltip" title="LinkedIn">
          <i class="bi bi-linkedin"></i>
        </a>
      </div>
    </div>
  </footer>

  <script>
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(el => new bootstrap.Tooltip(el));
  </script>
</body>
</html>
