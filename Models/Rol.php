<?php

namespace Model;

class Rol extends ActiveRecord {

    protected static $tabla = 'rol';
    protected static $columnasDB = ['idRol', 'rodescripcion'];

    // Atributos
    public $idRol;
    public $rodescripcion;

    // Constructor
    public function __construct($args = [])
    {
        $this->idRol = $args['idRol'] ?? null;
        $this->rodescripcion = $args['rodescripcion'] ?? null;
    }


    // Validaciones
    public function validar()  {
        
        if (!$this->rodescripcion) {
            self::$alertas['error'][] = 'La Descripción del Rol es Obligatoria';
        }

        return self::$alertas;
    }




}