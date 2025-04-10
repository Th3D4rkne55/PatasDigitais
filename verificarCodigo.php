<!--
Essa página faz parte do processo de verificação por e-mail do site Patas Digitais. 
Depois que o usuário solicita alguma ação que exige segurança, como recuperação de senha ou criação de conta, um código é enviado pro e-mail dele. 
Aqui, ele vai inserir esse código pra confirmar que é ele mesmo.

O visual segue o padrão do projeto, com a logo e nome no topo, tudo em tons escuros. 
No centro da página tem um formulário simples pra digitar o código, e no final, um rodapé com links pras redes sociais, como WhatsApp, Instagram e LinkedIn. 
Também tem um script no finalzinho que ativa aquelas dicas quando você passa o mouse nos ícones (os famosos tooltips).
-->


<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verificar Código - Patas Digitais</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/mobile.css" />
    <link rel="icon" href="./images/logo.png" />
  </head>

  <body class="d-flex flex-column min-vh-100 bg-dark text-white">
    
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0b3954">
      <div class="container-fluid px-4 py-2">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
          <img src="images/logo.png" alt="Logo" style="height: 45px" />
          <span class="fw-bold text-white">Patas Digitais</span>
        </a>
      </div>
    </nav>

    
    <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
      <div class="w-100 text-center" style="max-width: 400px; margin-top: 40px">
        <h3 class="mb-4">Verificação de Código</h3>

        <form action="php/processarCodigo.php" method="POST">
          <div class="mb-3">
            <label class="form-label text-white">Digite o código que foi enviado ao seu e-mail:</label>
            <input type="text" name="codigo" class="form-control text-center" required />
          </div>
          <button type="submit" class="btn btn-primary w-100">Verificar Código</button>
        </form>
      </div>
    </div>

    
    <footer class="text-white text-center py-2 mt-5" style="background-color: #05283d">
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
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      tooltipTriggerList.forEach((t) => new bootstrap.Tooltip(t));
    </script>
  </body>
</html>
