<?php

namespace App\Controller;

use App\Model\EstadocivilModel;
use App\Model\ClientesModel;

class ClientesController
{
    private ClientesModel $model;
    private EstadocivilModel $estadocivilModel;

    public function __construct()
    {
        $this->model = new ClientesModel();
        $this->estadocivilModel = new EstadocivilModel();
    }

    public function create()
    {
        $msgFeedback = [];
        if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['ds_telefone']) && isset($_POST['estadocivil_id'])) {
            $_POST['ds_urlfoto'] = $this->getMedia();
            $arrFeedback = $this->model->insert();
            if ($arrFeedback[0]) {
                header('Location: index.php');
            } else {
                $msgFeedback = $arrFeedback[1];
            }
        }
        $arrEstadocivil = $this->estadocivilModel->findAll();
        require "src/View/Clientes/create.php";
    }

    public function index()
    {   
        $clientes = $this->model->findAll();
        require "src/View/Clientes/index.php";
    }

    public function update()
    {
        $msgFeedback = [];
        if (isset($_POST['ds_nome']) && isset($_POST['dt_nascimento']) && isset($_POST['ds_cpf']) && isset($_POST['ds_email']) && isset($_POST['ds_telefone']) && isset($_POST['estadocivil_id'])) {
            $this->deleteMedia($_GET['id']);
            if(empty($_POST['ds_urlfoto'])){
                $_POST['ds_urlfoto'] = $this->getMedia();
            }
            $arrFeedback = $this->model->edit($_GET['id']);
            if ($arrFeedback[0]) {
                $msgFeedbackOk = 'success';
            } else {
                $msgFeedbackError = $arrFeedback[1];
            }
        }
        $arrEstadocivil = $this->estadocivilModel->findAll();
        $cliente = $this->model->read($_GET['id']);
        require "src/View/Clientes/update.php";
    }
    
    public function delete()
    {   
        $this->deleteMedia($_POST['id']);
        $returnDeleteCliente = $this->model->delete($_POST['id']);
        if(!$returnDeleteCliente[0]){
            $feedbackDeleteError = $returnDeleteCliente[1];
        }
        $clientes = $this->model->findAll();
        require "src/View/Clientes/index.php";
    }

    private function getMedia()
    {
        if (isset($_FILES['image'])){
            $arquivo = $_FILES['image'];
            
            
            if($arquivo['error']){
                echo('Falha ao enviar o arquivo');
            }

            if($arquivo['size'] > 2097152){
                echo('Arquivo maior que o limite máximo de tamanho (2Mb)');
            }
            
            $pasta = "public/images/";
            $nomeDoArquivo = $arquivo['name'];
            $nomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
            $path = $pasta.$nomeDoArquivo.".".$extensao;
            
            if($extensao != 'jpg' && $extensao != 'png'){
                echo('Tipo de arquivo não aceito');
            }else{
                move_uploaded_file($arquivo['tmp_name'], $path);
                return $path;
            }
        }
    }

    private function deleteMedia($id)
    {
        $dadosMidia = $this->model->read($id);
    
        $path = __DIR__.'/../../'.$dadosMidia->getUrlfoto();
        
        if(file_exists($path)){
            unlink($path);
        }
    }
}