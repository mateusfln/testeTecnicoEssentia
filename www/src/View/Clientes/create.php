<!DOCTYPE html>
<html lang="pt-br">

<?= require_once __DIR__.'/components/head.php' ?>

<body>
  
  <div class="container">
    <a href="index.php" class="btn btn-info mt-5"><h><i class="bi bi-arrow-left"></i></h5></a>
    <h1 class="text-center h1 font-weight-bold m-5">Adicionar Funcionário</h1>
    <?php
    if (!empty($msgFeedback)) {

      if ($msgFeedback == 'ds_cpf') {
          $mensagem = 'Não foi possivel salvar o funcionario, Cpf inválido!';
      } elseif ($msgFeedback = 'ds_email') {
          $mensagem = 'Não foi possivel salvar o funcionario, Email inválido!';
      } else {
          $mensagem = $msgFeedback;
      }
      
      echo "<div class='alert alert-danger' role='alert'>{$mensagem}</div>";
    }
    ?>
<div class="card p-4 shadow-sm ">
<form id="form-create-funcionario" action="index.php?a=create" method="post">

      <div class="row">
        <div class="col-4 mb-3">
          <label for="Nome" class="form-label">Nome:</label>
          <input required maxlength="255" type="text" class="form-control" name="ds_nome" id="Nome" placeholder="Digite o nome do funcionario" value="<?= $_POST['ds_nome'] ?? ''?>">
        </div>
        <div class="col-4 mb-3">
          <label for="CPF" class="form-label">CPF:</label>
          <input required maxlength="11" type="text" class="form-control" name="ds_cpf" id="CPF" placeholder="Digite o cpf do funcionario" value="<?= $_POST['ds_cpf'] ?? ''?>">
        </div>
        <div class=" col-4 mb-3">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input required type="date" class="form-control" id="nascimento" name="dt_nascimento"
          placeholder="Digite a data de nascimento do funcionario" value="<?= $_POST['dt_nascimento'] ?? ''?>">
      </div>
      </div>
      <div class="row">
        <div class="col-6 mb-3">
          <label for="Email" class="form-label">Email:</label>
          <input required maxlength="255" type="email" class="form-control" id="Email" name="ds_email" placeholder="Digite o Email do funcionario" value="<?= $_POST['ds_email'] ?? ''?>">
        </div>
        <div class="col-6 mb-3">
          <label for="estado-civil" class="form-label">Estado civil:</label>
          <select class="form-select" id="estado-civil" name="estadocivil_id">
          <?php foreach($arrEstadocivil as $estadocivil): 
            $selected = $estadocivil->getId() == $_POST['estadocivil_id'] ? 'selected' : '';
            ?>
              <option <?= $selected ?> value="<?=$estadocivil->getId()?>"><?= $estadocivil->getEstadoCivil()?></option>
          <?php endforeach;?>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
</div>
<?= require_once __DIR__.'/components/head.php' ?>
</body>
</html>