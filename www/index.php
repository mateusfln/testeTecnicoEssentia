<?php
use App\Controller\ClientesController;
require_once('vendor/autoload.php');
require_once('src/config/env.php');

$controller = new ClientesController();

$action = $_GET['a'] ?? 'index';

$controller->{$action}();