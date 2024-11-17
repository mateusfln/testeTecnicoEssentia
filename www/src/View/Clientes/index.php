<!DOCTYPE html>
<html lang="pt-br">
<?php 
$title = 'Crud de clientes';
require_once __DIR__.'/components/head.php' 
?>
<body>
  <h class="container">
    <h1 class="text-center h1 font-weight-bold mb-5">CRUD de Clientes</h1>

    

    <div class="container">
      <?php
      if (!empty($returnDeleteCliente)){
        if($returnDeleteCliente[0]){
          echo "<div class='alert alert-success' role='alert'>Cliente excluido com sucesso!</div>";
        } else {
          echo "<div class='alert alert-danger' role='alert'>Não foi possível excluir o Cliente, $feedbackDeleteError!</div>";
        }
      }
       ?>
      <div class="d-flex justify-content-end ">
        <div class="my-3">
          <a href="index.php?a=create" class="btn btn-success"><i class="bi bi-plus me-2"></i>Novo Cliente</a>
        </div>
      </div>
    <table class="table table-hover progress-table text-center shadow-sm ">
        <thead class="text-uppercase border-dark border-2">
        <tr>
            <th scope="col"> ID </th>
            <th scope="col"> Foto </th>
            <th scope="col"> Nome </th>
            <th scope="col"> Cpf </th>
            <th scope="col"> E-mail </th>
            <th scope="col"> telefone </th>
            <th scope="col"> Data de Nascimento </th>
            <th scope="col"> Estado Civil </th>
            <th scope="col"> Ações </th>
        </tr>
        </thead>
        <tbody>
    <?php if (empty($clientes)): ?>
      <tr>
          <td colspan="10">
            <div class="alert alert-warning" role="alert">
              Não existem registros disponíveis!
            </div>
          </td>
      </tr>
      <?php else: ?>
    <?php foreach($clientes as $cliente):?>
        <tr>
            <td><?=$cliente->getId()?></td>
            <td><img src="<?= !empty($cliente->getUrlfoto()) ? $cliente->getUrlfoto() : "public/client-icon.png"?>" alt="Imagem do cliente" class="rounded-circle" width="50px"></td>
            <td><?=$cliente->getNome()?></td>
            <td><?=$cliente->getCpf()?></td>
            <td><?=$cliente->getEmail()?></td>
            <td><?=$cliente->getTelefone()?></td>
            <td><?=$cliente->getDataDeNascimento()->format('d-m-Y')?></td>
            <td><?=$cliente->getEstadoCivil()?></td>
            <td>
                <ul class="d-flex justify-content-center gap-3">
                    <a href="index.php?a=update&id=<?=$cliente->getId()?>" class="btn btn-warning text-light"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                    <form action="index.php?a=delete" method="POST">
                        <input type="hidden" name="id" value="<?=$cliente->getId()?>">
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
    <?php require_once __DIR__.'/components/scripts.php' ?>
</body>
</html>
