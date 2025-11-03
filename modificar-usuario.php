<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/DataBase.php';

use Model\ActiveRecord;
use Controllers\UsuarioController;
use Controllers\Session;

$session = new Session();
ActiveRecord::setDB(conectarDB());

if (!$session->validar()) {
    header('Location: ./login.php');
    exit;
}

$titulo = 'Modificar Usuario';

UsuarioController::modificar();

?>