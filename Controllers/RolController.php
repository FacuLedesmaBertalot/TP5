<?php

namespace Controllers;

use Model\Rol;

class RolController {


    public static function index() {
        $roles = Rol::all();

        require '../View/rol/index.php';
    }


    // Procesa el alta de un nuevo usuario
    public static function alta() {

        $rol = new Rol();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rol->sincronizar($_POST);
            $alertas = $rol->validar();

            if (empty($alertas)) {
                $resultado =$rol->guardar();

                if ($resultado) {
                    header ('Location: /');
                    exit;
                }
            }
        }
        require '../Vistas/rol/alta.php';
    }

    
    // Procesa la modificacion de un rol existente
    public static function modificar() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
        if(!$id) {
            header('Location: /TP5/ver-roles.php');
            exit;
        }

        $rol = Rol::find($id); // Busca el rol existente en la BD
        $alertas = [];

        if(!$rol) {
            header('Location: /TP5/ver-roles.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rol->sincronizar($_POST);
            $alertas = $rol->validar();

            if(empty($alertas)) {
                $rol->guardar();
                header('Location: /TP5/ver-roles.php');
                exit;
            }
        }
        
        require '../Vistas/rol/modificar.php';
    }


    // Procesa la baja de un rol
    public static function baja() {
        // La eliminación siempre debe ser por POST para mayor seguridad
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if($id) {
                $rol = Rol::find($id);
                if($rol) {
                    $rol->eliminar();
                }
            }
            header('Location: /TP5/ver-roles.php');
            exit;
        }
    }



}
