<!--
Página de denúncia anônima do projeto Patas Digitais.

Inclui verificação de login com PHP (verificaLogin.php).

HTML com Bootstrap, ícones, estilos personalizados e favicon.

Navbar com logo e nome do projeto.

Formulário centralizado com campos obrigatórios:
- Cidade, estado e endereço do ocorrido.
- Descrição do caso.
- Upload opcional de imagem ou vídeo (aceita ambos os tipos).
- Dados são enviados para enviarDenuncia.php.

Rodapé com créditos e ícones sociais com tooltip.

Script ativa os tooltips de forma interativa.
-->


<?php include 'php/verificaLogin.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patas Digitais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/mobile.css">
  <link rel="icon" href="./images/logo.png" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0b3954;">
    <div class="container-fluid px-4 py-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="images/logo.png" alt="Logo" style="height: 45px" />
        <span class="fw-bold text-white">Patas Digitais</span>
      </a>
    </div>
  </nav>

  
  <div class="container mt-5">
    <h2 class="text-center">Denúncia Anônima</h2>
    <form action="./php/enviarDenuncia.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
      <div class="mb-3">
        <label class="form-label">Cidade</label>
        <input type="text" name="cidade" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Estado</label>
        <input type="text" name="estado" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Endereço do ocorrido</label>
        <input type="text" name="endereco" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" rows="4" class="form-control" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Anexar imagem/vídeo (opcional)</label>
        <input type="file" name="arquivo" class="form-control" accept="image/*,video/*" />
      </div>
      <button type="submit" class="btn btn-danger w-100">Enviar Denúncia</button>
    </form>
  </div>


  <footer class="text-white text-center py-2 mt-5" style="background-color: #05283d;">
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
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(t => new bootstrap.Tooltip(t));
  </script>

</body>
</html>
