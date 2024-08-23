<!DOCTYPE html>
<html lang="pt-br">

<?php 
$title = 'Editar cliente';
require_once __DIR__.'/components/head.php' 
?>

<body>
  <div class="container">
  <a href="index.php" class="btn btn-info mt-5"><h><i class="bi bi-arrow-left"></i></h5></a>
    <h1 class="text-center h1 font-weight-bold m-5">Editar dados de: <?= $cliente->getNome()?></h1>
    <?php
    if (!empty($msgFeedbackError)) {

      if ($msgFeedbackError == 'ds_cpf') {
          $mensagem = 'Não foi possivel salvar o cliente, Cpf inválido!';
      } elseif ($msgFeedbackError == 'ds_email') {
          $mensagem = 'Não foi possivel salvar o cliente, Email inválido!';
      } else{
        $mensagem = $msgFeedbackError;
      }
      echo "<div class='alert alert-danger' role='alert'>{$mensagem}</div>";
    }

    if (!empty($msgFeedbackOk)) {
      echo "<div class='alert alert-success' role='alert'>Cliente atualizado com sucesso!</div>";
    }
    ?>
<div class="card p-4 shadow-sm ">
<form id="form-edit-cliente" method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="col-4 mb-3">
          <label for="Nome" class="form-label">Nome:</label>
          <input required maxlength="255" type="text" class="form-control" id="Nome" name="ds_nome" placeholder="Digite o nome do cliente" value="<?= $cliente->getNome()?>">
        </div>
        <div class="col-4 mb-3">
          <label for="CPF" class="form-label">CPF:</label>
          <input required type="text" maxlength="11" class="form-control" id="CPF" name="ds_cpf" placeholder="Digite o cpf do cliente" value="<?= $cliente->getCpf()?>">
        </div>
        <div class=" col-4 mb-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input required type="date" class="form-control" id="nascimento" name="dt_nascimento"
          placeholder="Digite a data de nascimento do cliente" value="<?= $cliente->getDataDeNascimento()->format('Y-m-d')?>">
      </div>
      </div>
      <div class="row">
        <div class="col-6 mb-3">
          <label for="Email" class="form-label">Email:</label>
          <input required maxlength="255" type="email" class="form-control" id="Email" name="ds_email" placeholder="Digite o Email do cliente" value="<?= $cliente->getEmail()?>">
        </div>
        <div class="col-6 mb-3">
          <label for="Number" class="form-label">Telefone:</label>
          <input required maxlength="255" type="number" class="form-control" id="ds_telefone" name="ds_telefone" placeholder="Digite o seu numero de telefone" value="<?= $cliente->getTelefone() ?? ''?>">
        </div>
        <div class="col-4 mb-3">
          <label for="image" class="form-label">Foto de perfil:</label>
          <td><img src="<?= !empty($cliente->getUrlfoto()) ? $cliente->getUrlfoto() : "public/client-icon.png"?>" alt="Imagem do cliente" class="rounded-circle mb-1" width="50px"></td>
          <input type="file" class="form-control" id="image" name="image" placeholder="Escolha sua foto de perfil">
        </div>
        <div class="col-6 mb-3">
        <label for="estado-civil" class="form-label">Estado civil:</label>
          <select class="form-select" id="estado-civil" name="estadocivil_id">
          <?php foreach($arrEstadocivil as $estadocivil): 
            $selected = $estadocivil->getEstadoCivil() == $cliente->getEstadoCivil() ? 'selected' : '';
            ?>
              <option <?= $selected ?> value="<?=$estadocivil->getId()?>"><?= $estadocivil->getEstadoCivil()?></option>
          <?php endforeach;?>
          </select>
        </div>
      </div>

      <input type="submit" class="btn btn-primary" value="Editar">
    </form>
</div>
</div> 
</div> 
  </div>
  <?php require_once __DIR__.'/components/scripts.php' ?>
</body>

</html>