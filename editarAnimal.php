<!--
Página de edição de animal do projeto Patas Digitais.

Requer conexão com o banco e verificação de permissão admin.

Recebe o ID do animal via GET e busca os dados com SELECT.

HTML com Bootstrap, estilos personalizados e favicon.

Formulário centralizado que permite editar:
- Nome, idade, porte, doenças, instituição e status.
- Upload opcional de nova imagem.
- Envia ID e imagem atual como campos ocultos.

O formulário envia os dados para o script PHP de atualização.

Visual limpo, organizado e responsivo com Bootstrap.
-->


<?php
require 'php/conecta.php';
include 'php/verificaAdmin.php';

$id = $_GET['id'];
$sql = "SELECT * FROM animais WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patas Digitais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/mobile.css">
  <link rel="icon" href="./images/logo.png" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Animal - <?= $animal['nome'] ?></h2>
    <form action="php/atualizarAnimal.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
      <input type="hidden" name="id" value="<?= $animal['id'] ?>">
      <input type="hidden" name="imagem_atual" value="<?= $animal['imagem'] ?>">

      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= $animal['nome'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Idade</label>
        <input type="text" name="idade" class="form-control" value="<?= $animal['idade'] ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Porte</label>
        <select name="porte" class="form-control">
          <option <?= $animal['porte'] == 'Pequeno' ? 'selected' : '' ?>>Pequeno</option>
          <option <?= $animal['porte'] == 'Médio' ? 'selected' : '' ?>>Médio</option>
          <option <?= $animal['porte'] == 'Grande' ? 'selected' : '' ?>>Grande</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Doenças</label>
        <textarea name="doencas" class="form-control"><?= $animal['doencas'] ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Instituição</label>
        <input type="text" name="instituicao" class="form-control" value="<?= $animal['instituicao'] ?>" required>
      </div>
      <div class="mb-3">
  <label class="form-label">Status</label>
  <select name="status" class="form-control">
    <option <?= $animal['status'] == 'Disponível' ? 'selected' : '' ?>>Disponível</option>
    <option <?= $animal['status'] == 'Adotado' ? 'selected' : '' ?>>Adotado</option>
  </select>
</div>
      <div class="mb-3">
        <label class="form-label">Nova Imagem (opcional)</label>
        <input type="file" name="nova_imagem" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
    </form>
  </div>
</body>
</html>
