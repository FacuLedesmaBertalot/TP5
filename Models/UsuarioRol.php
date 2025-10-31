<?php

namespace Model;

class UsuarioRol extends ActiveRecord {

    protected static $tabla = 'usuarioRol';
    protected static $columnasDB = ['idUsuario', 'idRol'];


    public $idUsuario;
    public $idRol;


    // Construct
    public function __construct($args = [])
    {
        $this->idUsuario = $args['idUsuario'] ?? null;
        $this->idRol = $args['idRol'] ?? null;
    }

    // Validaciones
    public function validar() {
        if(!$this->idUsuario) {
            self::$alertas['error'][] = 'El ID del Usuario es obligatorio';
        }
        if(!$this->idRol) {
            self::$alertas['error'][] = 'El ID del Rol es obligatorio';
        }
        return self::$alertas;
    }



    // MÉTODOS 


    // Elimina la relacion entre un usuario y un rol
    public function eliminarRelacion() {
        $query = "DELETE FROM " . static::$tabla .
        "WHERE idUsuario " . self::$db->escape_string($this->idUsuario) .
        "AND idRol = " . self::$db->escape_string($this->idRol) .
        "LIMIT 1";
        
        $resultado = self::$db->query($query);
        return $resultado;
    }


    // Busca los roles asociados a un id
    public static function findRolesPorUsuario($idUsuario) {
        $query = "SELECT r.*
                FROM rol r " . 
                "INNER JOIN usuarioRol ur ON r.idRol = ur.idRol " . 
                "WHERE ur.idUsuario = {$idUsuario}";

        return Rol::SQL($query);
    }





}