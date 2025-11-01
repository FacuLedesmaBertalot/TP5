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

        $loginExitoso = false;
        $usuario = Usuario::where('usnombre', $nombreUsuario);

        if ($usuario) {
            if (password_verify($psw, $usuario->uspass)) {
                $_SESSION['login'] = true;
                $_SESSION['idUsuario'] = $usuario->idUsuario;
                $loginExitoso = true;
            }
        }

        return $loginExitoso;
    }


    // Valida si la sesión actual tiene un usuario y es válida
    public function validar() {
        $esValida = false;

        if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['idUsuario'])) {
            $esValida = true;
        }

        return $esValida;
    }

    // Devuelve true o false si la sesión está activa o no
    public function activa() {
        return $this->validar();
    }


    // Devuelve el Objeto del Usuario Logueado
    public function getUsuario() {
        $usuarioLogueado = null;

        if ($this->activa()) {
            $usuarioLogueado = Usuario::find($_SESSION['idUsuario']);
        }

        return $usuarioLogueado;
    }


    // Devuelve el rol del usuario logueado
    public function getRol() {
        $roles = [];

        if ($this->activa()) {
            $roles = UsuarioRol::findRolesPorUsuario($_SESSION['idUsuario']);
        }
        
        return $roles;
    }

    // Cerrar sesión
    public function cerrar() {
        $_SESSION = [];
        session_destroy();
    }


}