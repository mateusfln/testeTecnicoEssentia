<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD de Funcionários</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
  <h class="container">
    <h1 class="text-center h1 font-weight-bold mb-5">CRUD de Funcionários</h1>

    

    <div class="container">
      <?php
      if (!empty($returnDeleteFuncionario)){
        if($returnDeleteFuncionario[0]){
          echo "<div class='alert alert-success' role='alert'>Funcionário excluido com sucesso!</div>";
        } else {
          echo "<div class='alert alert-danger' role='alert'>Não foi possível excluir o funcionário, $feedbackDeleteError!</div>";
        }
      }
       ?>
      <div class="d-flex justify-content-end ">
        <div class="my-3">
          <a href="index.php?a=create" class="btn btn-success"><i class="bi bi-plus me-2"></i>Novo Funcionário</a>
        </div>
      </div>
    <table class="table table-hover progress-table text-center shadow-sm ">
        <thead class="text-uppercase border-dark border-2">
        <tr>
            <th scope="col"> ID </th>
            <th scope="col"> Nome </th>
            <th scope="col"> Cpf </th>
            <th scope="col"> E-mail </th>
            <th scope="col"> Data de Nascimento </th>
            <th scope="col"> Estado Civil </th>
            <th scope="col"> Ações </th>
        </tr>
        </thead>
        <tbody>
    <?php if (empty($funcionarios)): ?>
      <tr>
          <td colspan="10">
            <div class="alert alert-warning" role="alert">
              Não existem registros disponíveis!
            </div>
          </td>
      </tr>
      <?php else: ?>
    <?php foreach($funcionarios as $funcionario):?>
        <tr>
            <td><?=$funcionario->getId()?></td>
            <td><?=$funcionario->getNome()?></td>
            <td><?=$funcionario->getCpf()?></td>
            <td><?=$funcionario->getEmail()?></td>
            <td><?=$funcionario->getDataDeNascimento()->format('d-m-Y')?></td>
            <td><?=$funcionario->getEstadoCivil()?></td>
            <td>
                <ul class="d-flex justify-content-center gap-3">
                    <a href="index.php?a=update&id=<?=$funcionario->getId()?>" class="btn btn-warning text-light"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                    <form action="index.php?a=delete" method="POST">
                        <input type="hidden" name="id" value="<?=$funcionario->getId()?>">
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-2"></i>Excluir</button>
                    </form>
              </ul>
            </td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
        </tbody>
    </table>
    </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
