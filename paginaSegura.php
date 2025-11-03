<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/DataBase.php';

use Model\ActiveRecord;

ActiveRecord::setDB(conectarDB());
// --- FIN DE LOS PASOS QUE FALTABAN ---

// 5. Iniciar la sesión (esto ya lo tenías bien)
use Controllers\Session;
$session = new Session();

// 6. Proteger la página
if (!$session->validar()) {
    header('Location: login.php');
    exit;
}

// 7. Ahora sí, al llamar a getUsuario(), la conexión a la BD ya existe
$titulo = 'Página Segura';
$usuario = $session->getUsuario(); 
require_once __DIR__ . '/View/Includes/header.php';
?>

<div class="alert alert-success">
    <h4 class="alert-heading">¡Bienvenido, <?php echo htmlspecialchars($usuario->usnombre); ?>!</h4>
    <p>Has iniciado sesión correctamente y estás en una página protegida.</p>
</div>

<a href="listar-usuarios.php" class="btn btn-info">Ir al listado de usuarios</a>

<?php require_once __DIR__ . '/View/Includes/footer.php'; ?>