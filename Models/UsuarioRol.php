<?php

require_once 'DataBase.php';

class Rol {

    // Atributos
    private $idRol;
    private $rodescripcion;
    private $mensajeOperacion;

    public function __construct()
    {
        $this->idRol = 0;
        $this->rodescripcion = '';
        $this->mensajeOperacion = '';
    }


    // GETTERS
    public function getIdRol() {
        return $this->idRol;
    }

    public function getRoDescripcion() {
        return $this->rodescripcion;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    
    // SETTERS
    public function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    public function setRoDescripcion($rodescripcion) {
        $this->rodescripcion = $rodescripcion;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function setear($idRol, $rodescripcion) {
        $this->setIdRol($idRol);
        $this->setRoDescripcion($rodescripcion);
    }


    // --- MÉTODOS CRUD ---

    public function cargar()
    {
        $resp = false;
        $dataBase = new DataBase();
        $sql = "SELECT * FROM rol WHERE idrol = ?";
        
        if ($dataBase->iniciar()) {
            if ($res = $dataBase->ejecutar($sql, "i", [$this->getIdRol()])) {
                if ($res > 0) {
                    $row = $dataBase->registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("rol->cargar: " . $dataBase->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $dataBase = new DataBase();
        $sql = "INSERT INTO rol(rodescripcion) VALUES (?)";
        
        if ($dataBase->iniciar()) {
            if ($id = $dataBase->ejecutar($sql, "s", [$this->getRoDescripcion()])) {
                $this->setIdRol($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion("rol->insertar: " . $dataBase->getError());
            }
        } else {
            $this->setMensajeOperacion("rol->insertar: " . $dataBase->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $dataBase = new DataBase();
        $sql = "UPDATE rol SET rodescripcion = ? WHERE idrol = ?";
        
        if ($dataBase->iniciar()) {
            $params = [$this->getRoDescripcion(), $this->getIdRol()];
            if ($dataBase->ejecutar($sql, "si", $params)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("rol->modificar: " . $dataBase->getError());
            }
        } else {
            $this->setMensajeOperacion("rol->modificar: " . $dataBase->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $dataBase = new DataBase();
        $sql = "DELETE FROM rol WHERE idrol = ?";
        
        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($sql, "i", [$this->getIdRol()])) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("rol->eliminar: " . $dataBase->getError());
            }
        } else {
            $this->setMensajeOperacion("rol->eliminar: " . $dataBase->getError());
        }
        return $resp;
    }

    public static function listar($condicion = "")
    {
        $arreglo = [];
        $dataBase = new DataBase();
        $sql = "SELECT * FROM rol";
        if ($condicion != "") {
            $sql .= ' WHERE ' . $condicion;
        }
        
        if ($dataBase->iniciar()) {
            $res = $dataBase->ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $dataBase->registro()) {
                        $obj = new Rol();
                        $obj->setear($row['idrol'], $row['rodescripcion']);
                        array_push($arreglo, $obj);
                    }
                }
            }
        }
        return $arreglo;
    }





}