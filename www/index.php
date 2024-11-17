<?php
use App\Controller\ClientesController;
use App\Model\ClientesModel;
use App\Model\Entity\Cliente;
use App\Model\EstadocivilModel;

require_once('vendor/autoload.php');
require_once('src/config/env.php');

$controller = new ClientesController(new ClientesModel(), new EstadocivilModel(), new Cliente());

$action = $_GET['a'] ?? 'index';

$controller->{$action}();