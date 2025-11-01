<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'tp5');

    if ($db->connect_error) {
        echo "Error: No se pudo conectar a MySQL. " . $db->connect_error;
        exit;
    }

    $db->set_charset("utf8");

    return $db;
}