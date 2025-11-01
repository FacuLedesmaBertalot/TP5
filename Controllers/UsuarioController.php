<?php

namespace Controllers;


use Model\Usuario;

class UsuarioController {
    
    public static function index() {
        $usuarios = Usuario::all();

        require '../View/listarUsuario.php';
    }


    // Procesa el alta de un nuevo usuario
    public static function alta() {

        $usuario = new Usuario();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $usuario->hashPassword();
                $resultado =$usuario->guardar();

                if ($resultado) {
                    header ('Location: /TP5/listar-usuario.php');
                    exit;
                }
            }
        }
        require '../Vistas/usuarios/alta.php';
    }

    
    // Procesa la info de un usuario existente

    public static function modificar() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id) {
            header ('Location: /');
            exit;
        }

        $usuario = Usuario::find($id);
        $alertas = [];

        if (!$usuario) {
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();


            if(empty($alertas)) {
                $usuario->guardar();
                header('Location: /TP5/ruta/a/tu/listado.php');
                exit;
            }
        }

        require '../Vistas/usuarios/modificar.php';
    }


    // Procesa la baja de un usuario

    public static function baja() {

        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if ($id) {
                $usuario = Usuario::find($id);

                if ($usuario) {
                    $usuario->eliminar();
                }
            }
            header ('Location : /TP5/listar-usuarios.php');
            exit;
        }
    }

}