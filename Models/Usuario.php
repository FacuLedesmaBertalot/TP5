<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuario';
    protected static $columnasDB = ['idUsuario', 'usnombre', 'uspass', 'usmail', 'usdeshabilitado'];
    protected static $primaryKey = 'idUsuario';


    public $idUsuario;
    public $usnombre;
    public $uspass;
    public $usmail;
    public $usdeshabilitado;

    // Construct
    public function __construct($args = [])
    {
        $this->idUsuario = $args['idUsuario'] ?? null;
        $this->usnombre = $args['usnombre'] ?? '';
        $this->uspass = $args['uspass'] ?? '';
        $this->usmail = $args['usmail'] ?? '';
        $this->usdeshabilitado = $args['usdeshabilitado'] ?? null;
    }

    // Validaciones
    public function validar() {
        if(!$this->usnombre) {
            self::$alertas['error'][] = 'El nombre de usuario es obligatorio';
        }
        if(!$this->usmail) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if(strlen($this->uspass) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }


    // Hashear password
    public function hashPassword() {
        $this->uspass = password_hash($this->uspass, PASSWORD_DEFAULT);
    }



}
