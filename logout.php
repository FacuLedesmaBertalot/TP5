<?php
// 1. Cargar el autoloader de Composer para poder usar tus clases.
require_once __DIR__ . '/vendor/autoload.php';

// 2. Importar la clase Session.
use Controllers\Session;

// 3. Crear el objeto Session. Su constructor automáticamente inicia la sesión.
$session = new Session();

// 4. Llamar al método para cerrar y destruir la sesión.
$session->cerrar();

// 5. Redirigir al usuario a la página de login.
header('Location: login.php');
exit; // Es una buena práctica usar exit() después de una redirección.