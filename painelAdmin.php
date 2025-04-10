<!--
Página de cadastro de animais do projeto Patas Digitais.

Verifica se o usuário é admin com include em PHP.

HTML com Bootstrap, ícones, estilos e favicon.

Navbar no topo com logo e nome do projeto.

Formulário centralizado para cadastrar animal:
nome, idade, porte, doenças, instituição, imagens e status.

Formulário envia para 'php/cadastrarAnimal.php' via POST.

Rodapé com créditos e ícones de redes sociais.

Tooltips ativados com script no final.

Usa Bootstrap para deixar tudo responsivo.
-->


<?php
include 'php/verificaAdmin.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patas Digitais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/mobile.css" />
  <link rel="icon" href="./images/logo.png" />
</head>

<body class="d-flex flex-column min-vh-100">
  

  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0b3954">
    <div class="container-fluid px-4 py-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="images/logo.png" alt="Logo" style="height: 45px" />
        <span class="fw-bold text-white">Patas Digitais</span>
      </a>
    </div>
  </nav>

  
  <div class="container mt-5 flex-grow-1">
    <h2 class="text-center mb-4">Cadastrar Novo Animal</h2>

    <form action="./php/cadastrarAnimal.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label">Nome do animal</label>
        <input type="text" name="nome" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Idade</label>
        <input type="text" name="idade" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Porte</label>
        <select name="porte" class="form-control" required>
          <option value="">Selecione</option>
          <option value="Pequeno">Pequeno</option>
          <option value="Médio">Médio</option>
          <option value="Grande">Grande</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Possíveis doenças</label>
        <textarea name="doencas" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Instituição responsável</label>
        <input type="text" name="instituicao" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagens do animal</label>
        <input type="file" name="imagens[]" class="form-control" accept="image/*" multiple required>
      </div>

      <div class="mb-3">
        <label class="form-label">Status de Adoção</label>
        <select name="status" class="form-control" required>
          <option value="Disponível" selected>Disponível</option>
          <option value="Adotado">Adotado</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success w-100">Cadastrar Animal</button>
    </form>
  </div>

  
  <footer class="text-white text-center py-3 mt-auto" style="background-color: #05283d">
    <div class="container">
      <p class="mb-1 fs-6">
        © Patas Digitais - Inovação e Empatia ao Alcance de um Clique
      </p>

      <div class="d-flex justify-content-center gap-5 mt-4">
        <a
          href="https://wa.me/5567992699299"
          class="text-white fs-4"
          target="_blank"
          data-bs-toggle="tooltip"
          title="WhatsApp"
        >
          <i class="bi bi-whatsapp"></i>
        </a>
        <a
          href="https://www.instagram.com/_ericknathan_?igsh=bzhhYmQ2dGg4bG51"
          class="text-white fs-4"
          target="_blank"
          data-bs-toggle="tooltip"
          title="Instagram"
        >
          <i class="bi bi-instagram"></i>
        </a>
        <a
          href="https://www.linkedin.com/in/erick-nathan/"
          class="text-white fs-4"
          target="_blank"
          data-bs-toggle="tooltip"
          title="LinkedIn"
        >
          <i class="bi bi-linkedin"></i>
        </a>
      </div>
    </div>
  </footer>

  
  <script>
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(t => new bootstrap.Tooltip(t));
  </script>
</body>
</html>
