<?php

use Model\ActiveRecord;
use Controllers\Session;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../Config/DataBase.php';

    
    ActiveRecord::setDB(conectarDB());

    $session = new Session();
    $nombreUsuario = $_POST['nombreUsuario'];
    $psw = $_POST['psw'];

    // Si el método iniciar() devuelve true...
    if ($session->iniciar($nombreUsuario, $psw)) {
        // ...redirigimos a la página segura.
        header('Location: ../paginaSegura.php');
        exit;
    }
}
// Si falla, redirigimos de vuelta al login con un mensaje de error.
header('Location: ../login.php?error=1');
exit;