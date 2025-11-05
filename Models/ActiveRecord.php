<?php

namespace Model;

class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $primaryKey = 'id'; // Default, se puede sobrescribir en cada modelo

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $primaryKey = static::$primaryKey;
        $id = $this->$primaryKey;

        if (!is_null($id)) {
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $primaryKey = static::$primaryKey;

        return self::where($primaryKey, $id);
    }   

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Busca un registro por su id
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = ? LIMIT 1";
        $stmt = self::$db->prepare($query);
        if (!$stmt) return null;

        // Vinculamos el valor de forma segura.
        $stmt->bind_param("s", $valor);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $registro = $resultado->fetch_assoc();

        if (!$registro) {
            return null;
        }

        return static::crearObjeto($registro);
    }


    // Consulta Plana de SQL (utilizar cuando los métodos del modelo no son suficientes)
    public static function SQL($query) {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        $atributos = $this->atributos();
        $pares = [];
        foreach ($atributos as $key => $value) {
            $pares[] = "{$key}=?";
        }
        $query = "UPDATE " . static::$tabla . " SET " . join(', ', $pares) . " WHERE " . static::$primaryKey . " = ? LIMIT 1";

        $stmt = self::$db->prepare($query);
        if (!$stmt) return false;

        $types = str_repeat('s', count($atributos) + 1); // +1 por el ID
        $primaryKey = static::$primaryKey;
        $valores = [...array_values($atributos), $this->$primaryKey];
        $stmt->bind_param($types, ...$valores);

        return $stmt->execute();
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $primaryKey = static::$primaryKey;
        $id = $this->$primaryKey;

        $query = "DELETE FROM " . static::$tabla . " WHERE " . static::$primaryKey . " = ? LIMIT 1";

        $stmt = self::$db->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id); // 'i' para integer
        return $stmt->execute();
    }



    // Busca todos los registros que coincidan con una columna y valor
    // Similar al where, pero sin Limit 1 y devuelve array
    public static function whereAll($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = ?";
        
        $stmt = self::$db->prepare($query);
        if (!$stmt) return []; 


        $stmt->bind_param("s", $valor); 
        $stmt->execute();

        $resultado = $stmt->get_result();
        
        // Iterar los resultados y crear objetos
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $stmt->close();

        // retornar los resultados
        return $array;
    }
}
