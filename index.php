<!--
Página principal de adoção do projeto Patas Digitais.

Inicia sessão com PHP para verificar login e exibir conteúdo dinâmico.

HTML com Bootstrap, ícones, estilos personalizados e favicon.

Navbar com nome do projeto e busca de animais/instituições.

Seção principal lista todos os animais cadastrados.
Cada card mostra:
- Imagem, nome, idade, porte, doenças, instituição e status.
- Botão "Adote!" (ativa só pra usuários logados).
- Botões de edição/exclusão (visíveis apenas para admin).

Busca feita via GET, e resultado vem do banco com SELECT filtrando por nome ou instituição.

Rodapé com créditos e ícones para redes sociais.

Tooltips ativados no final com script Bootstrap.

Responsivo e limpo usando Bootstrap.
-->


<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patas Digitais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/mobile.css">
  <link rel="icon" href="./images/logo.png" />
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container-fluid">

    
    <a class="navbar-brand d-flex align-items-center ms-3" href="index.php">
      <img src="images/logo.png" alt="Logo" width="60" height="60" class="me-2" />
      <span class="fw-bold text-white fs-6">
        <?php 
          echo isset($_SESSION['usuario']) 
            ? "Bem-vindo, " . htmlspecialchars($_SESSION['usuario']) 
            : "Patas Digitais";
        ?>
      </span>
    </a>

    
    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
  <span class="navbar-toggler-icon"></span>
</button>

    
    <div class="collapse navbar-collapse" id="navbarContent">

      
      <form class="d-flex mx-auto my-2" method="GET" action="index.php" style="max-width: 400px; width: 100%;">
        <input class="form-control me-2 rounded-pill px-4" type="search" name="busca" placeholder="Buscar animal ou instituição..." aria-label="Buscar">
        <button class="btn btn-light rounded-pill px-4" type="submit">Buscar</button>
      </form>

      
      <ul class="navbar-nav ms-1 mb-lg-0 d-flex align-items-center me-3">
        <li class="nav-item"><a class="nav-link text-white fw-semibold" href="index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold" href="doe.html">Doe</a></li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold" href="denuncia.php">Denuncie</a></li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold nowrap" href="quemSomos.html">Quem Somos</a></li>
        <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
          <li class="nav-item"><a class="nav-link text-warning fw-bold" href="painelAdmin.php">Admin</a></li>
        <?php endif; ?>
        <li class="nav-item">
        <?php if (isset($_SESSION['usuario'])): ?>
  <li class="nav-item">
    <a class="nav-link text-warning fw-bold" href="editarPerfil.php">Editar</a>
  </li>
<?php endif; ?>
          <?php if (isset($_SESSION['usuario'])): ?>
            <a class="nav-link text-danger" href="php/logout.php">Sair</a>
          <?php else: ?>
            <a class="nav-link text-white fw-semibold" href="login.html">Login</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div style="height: 40px;"></div>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Animais para Adoção</h2>
  <div class="row">
    <?php
    require 'php/conecta.php';

    $busca = isset($_GET['busca']) ? $conexao->real_escape_string($_GET['busca']) : '';
    $sql = $busca 
      ? "SELECT * FROM animais WHERE nome LIKE '%$busca%' OR instituicao LIKE '%$busca%' ORDER BY criado_em DESC"
      : "SELECT * FROM animais ORDER BY criado_em DESC";

    $result = $conexao->query($sql);

    while ($animal = $result->fetch_assoc()):
    ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?= $animal['imagem'] ?>" class="card-img-top" alt="<?= $animal['nome'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title d-flex justify-content-between align-items-center">
              <?= htmlspecialchars($animal['nome']) ?>
              <span class="badge bg-<?= $animal['status'] === 'Disponível' ? 'success' : 'secondary' ?>">
                <?= $animal['status'] ?>
              </span>
            </h5>
            <p class="card-text mb-3">
              Idade: <?= htmlspecialchars($animal['idade']) ?> | Porte: <?= htmlspecialchars($animal['porte']) ?><br>
              <?= $animal['doencas'] ? "Doenças: " . htmlspecialchars($animal['doencas']) . "<br>" : "" ?>
              ONG: <?= htmlspecialchars($animal['instituicao']) ?>
            </p>

            <?php if ($animal['status'] === 'Disponível'): ?>
              <?php if (isset($_SESSION['usuario'])): ?>
                <a href="https://wa.me/+5567992699299?text=Olá, tenho interesse em adotar o animal <?= urlencode($animal['nome']) ?>!" 
                class="btn btn-success mb-2" 
                target="_blank">
                Adote!
                </a>
              <?php else: ?>
                <a href="#" class="btn btn-primary disabled mb-2">Adote!</a>
                <small class="text-muted">* Faça login para adotar</small>
              <?php endif; ?>
            <?php else: ?>
              <button class="btn btn-secondary mb-2" disabled>Já Adotado</button>
            <?php endif; ?>

            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
              <a href="editarAnimal.php?id=<?= $animal['id'] ?>" class="btn btn-warning btn-sm mb-2">Editar</a>
              <form action="php/excluirAnimal.php" method="POST" onsubmit="return confirm('Tem certeza?')" class="d-inline">
                <input type="hidden" name="id" value="<?= $animal['id'] ?>">
                <input type="hidden" name="imagem" value="<?= $animal['imagem'] ?>">
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<footer class="text-white text-center py-1 mt-4" style="background-color: #05283d;">
  <div class="container">
    <p class="mb-1 fs-6">
    © Patas Digitais - Inovação e Empatia ao Alcance de um Clique
    </p>

    
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
      const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
      );
      tooltipTriggerList.forEach((tooltipTriggerEl) => {
        new bootstrap.Tooltip(tooltipTriggerEl);
      });
    </script>
  </body>
</html>
