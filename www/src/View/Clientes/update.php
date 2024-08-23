<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cliente</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
  <a href="index.php" class="btn btn-info mt-5"><h><i class="bi bi-arrow-left"></i></h5></a>
    <h1 class="text-center h1 font-weight-bold m-5">Editar dados de: <?= $cliente->getNome()?></h1>
    <?php
    if (!empty($msgFeedbackError)) {

      if ($msgFeedbackError == 'ds_cpf') {
          $mensagem = 'Não foi possivel salvar o funcionario, Cpf inválido!';
      } elseif ($msgFeedbackError == 'ds_email') {
          $mensagem = 'Não foi possivel salvar o funcionario, Email inválido!';
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
<form id="form-edit-funcionario" method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="col-4 mb-3">
          <label for="Nome" class="form-label">Nome:</label>
          <input required maxlength="255" type="text" class="form-control" id="Nome" name="ds_nome" placeholder="Digite o nome do funcionario" value="<?= $cliente->getNome()?>">
        </div>
        <div class="col-4 mb-3">
          <label for="CPF" class="form-label">CPF:</label>
          <input required type="text" maxlength="11" class="form-control" id="CPF" name="ds_cpf" placeholder="Digite o cpf do funcionario" value="<?= $cliente->getCpf()?>">
        </div>
        <div class=" col-4 mb-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input required type="date" class="form-control" id="nascimento" name="dt_nascimento"
          placeholder="Digite a data de nascimento do funcionario" value="<?= $cliente->getDataDeNascimento()->format('Y-m-d')?>">
      </div>
      </div>
      <div class="row">
        <div class="col-6 mb-3">
          <label for="Email" class="form-label">Email:</label>
          <input required maxlength="255" type="email" class="form-control" id="Email" name="ds_email" placeholder="Digite o Email do funcionario" value="<?= $cliente->getEmail()?>">
        </div>
        <div class="col-6 mb-3">
          <label for="Number" class="form-label">Telefone:</label>
          <input required maxlength="255" type="number" class="form-control" id="ds_telefone" name="ds_telefone" placeholder="Digite o seu numero de telefone" value="<?= $cliente->getTelefone() ?? ''?>">
        </div>
        <div class="col-6 mb-3">
          <label for="image" class="form-label">Foto de perfil:</label>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>

</html>