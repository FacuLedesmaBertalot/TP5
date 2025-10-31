<?php

namespace Controllers;

use Model\Usuario;
use Model\UsuarioRol;

class Session {

    // Constructor que inicia la sesión, se asegura que session_start() se llame una sola vez
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    // Inicia la sesión para que un usuario despues de validar sus credenciales

    public function iniciar($nombreUsuario, $psw) {

        $resultado = false;
        $usuario = Usuario::where('usnombre', $nombreUsuario);

        if ($usuario) {
            if (password_verify($psw, $usuario->uspass)) {
                $_SESSION['login'] = true;
                $_SESSION['idUsuario'] = $usuario->idUsuario;
                $resultado = true;
            }
        }

        return $resultado;
    }


    
}