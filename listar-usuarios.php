<?php
// 1. Cargar el autoloader de Composer.
require_once __DIR__ . '/vendor/autoload.php';

// 2. Cargar la configuración de la base de datos.
require_once __DIR__ . '/config/database.php';

// 3. Importar las clases necesarias.
use Model\ActiveRecord;
use Controllers\UsuarioController;
use Controllers\Session;

// 4. Iniciar la sesión y la conexión a la BD.
$session = new Session();
ActiveRecord::setDB(conectarDB());

// 5. Proteger la página: si el usuario no está logueado, lo redirige al login.
if (!$session->validar()) {
    header('Location: login.php');
    exit;
}

// 6. Preparar el título para la vista (esto lo usará tu header.php).
$titulo = 'Listado de Usuarios';

// 7. Llamar al método del controlador que hace todo el trabajo.
UsuarioController::index();