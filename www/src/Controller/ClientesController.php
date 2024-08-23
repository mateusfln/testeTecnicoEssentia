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
        $returnDeleteCliente = $this->model->delete($_POST['id']);
        if(!$returnDeleteCliente[0]){
            $feedbackDeleteError = $returnDeleteCliente[1];
        }
        $clientes = $this->model->findAll();
        require "src/View/Clientes/index.php";
    }
}