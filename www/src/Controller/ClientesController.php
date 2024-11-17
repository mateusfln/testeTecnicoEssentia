<?php

namespace App\Controller;

use App\Model\Entity\Cliente;
use App\Model\Entity\Imagem;
use App\Model\Interfaces\ClientesModelInterface;
use App\Model\Interfaces\EstadocivilModelInterface;

class ClientesController
{
    private ClientesModelInterface $model;
    private EstadocivilModelInterface $estadocivilModel;
    private Cliente $entity;

    public function __construct(ClientesModelInterface $clientesModel, EstadocivilModelInterface $estadoCivilModel, Cliente $clienteEntity)
    {
        $this->model = $clientesModel;
        $this->entity = $clienteEntity;
        $this->estadocivilModel = $estadoCivilModel;
    }

    public function create()
    {
        $msgFeedback = [];
        
        if ($this->allRequiredFieldsAreFilled($this->entity->getRequiredFields())) {
            $_POST['ds_urlfoto'] = "";
            if(!empty($_FILES['image']['name'])){
                $_POST['ds_urlfoto'] = $this->getMedia();
            }
            $arrFeedback = $this->model->insert();
            if ($arrFeedback[0]) {
                header('Location: index.php');
            } else {
                $msgFeedback = $arrFeedback[1];
            }
        }
        $arrEstadocivil = $this->estadocivilModel->findAll();
        compact('arrEstadocivil', 'msgFeedback');
        require "src/View/Clientes/create.php";
    }

    public function index()
    {   
        $clientes = $this->model->findAll();
        compact('clientes');
        require "src/View/Clientes/index.php";
    }

    public function update()
    {
        $msgFeedback = [];
        if ($this->allRequiredFieldsAreFilled($this->entity->getRequiredFields())) {
            if(!empty($_FILES['image']['name'])){
                $this->deleteMedia($_GET['id']);
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

    private function getMedia(): string
    {
        $image = new Imagem();
        $image->validate(
            $_FILES['image']['name'], 
            $_FILES['image']['error'], 
            $_FILES['image']['size'], 
            $_FILES['image']['tmp_name']
        );
        return $image->getFullPath();
    }
    
    private function deleteMedia($id)
    {
        $dadosMidia = $this->model->read($id);
    
        $path = __DIR__.'/../../'.$dadosMidia->getUrlfoto();
        
        if(file_exists($path)){
            unlink($path);
        }
    }

    private function allRequiredFieldsAreFilled(array $requiredFields): bool
    {
        foreach($requiredFields as $field){
            if(!isset($_POST[$field])){
                return false;
            }
        }
        return true;
    }
}