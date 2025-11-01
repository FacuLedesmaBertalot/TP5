<?php
// listar-usuarios.php (en la raíz de TP5/)

// 1. Cargar el autoloader de Composer.
require_once __DIR__ . '/vendor/autoload.php';

// 2. Cargar la configuración de la base de datos.
require_once __DIR__ . '/config/database.php';

// 3. Importar las clases que vamos a usar.
use Model\ActiveRecord;
use Controllers\UsuarioController;

// 4. Crear la conexión y pasarla a ActiveRecord.
$db = conectarDB();
ActiveRecord::setDB($db);

// 5. Llamar al método del controlador. Este método se encargará de
//    crear la variable $usuarios y luego de incluir la vista.
UsuarioController::index();