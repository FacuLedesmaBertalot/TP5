<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/DataBase.php';

$db = conectarDB();

\Model\ActiveRecord::setDB($db);

use Controllers\UsuarioController;

UsuarioController::baja();