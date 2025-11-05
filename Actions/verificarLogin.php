<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Config/DataBase.php'; 


$db = conectarDB(); 
\Model\ActiveRecord::setDB($db); 

use Controllers\Session;
$session = new Session(); 


$nombreUsuario = $_POST['nombreUsuario'] ?? null;
$password = $_POST['psw'] ?? null;

// Llamar al método iniciar()
if ($nombreUsuario && $password && $session->iniciar($nombreUsuario, $password)) {
    header('Location: /TP5/paginaSegura.php');
    exit;
} else {
    header('Location: /TP5/login.php?error=1');
    exit;
}