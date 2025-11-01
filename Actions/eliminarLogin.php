<?php

use Model\ActiveRecord;
use Model\Usuario;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../config/database.php';


    ActiveRecord::setDB(conectarDB());

    $id = filter_var($_POST['idUsuario'], FILTER_VALIDATE_INT);
    if ($id) {
        $usuario = Usuario::find($id);


        // debug
        echo "<pre>";
        var_dump($usuario);
        echo "</pre>";
        exit;
        if ($usuario) {
            $usuario->usdeshabilitado = date('Y-m-d H:i:s');
            $usuario->guardar();
        }
    }
}
header('Location: ../listar-usuarios.php');
exit;