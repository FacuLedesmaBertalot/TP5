<?php
require_once __DIR__ . '/vendor/autoload.php';
use Controllers\Session;
$session = new Session();

// Si ya está logueado, lo redirigimos para que no vea el login de nuevo.
if ($session->validar()) {
    header('Location: paginaSegura.php');
    exit;
}

$titulo = 'Iniciar Sesión';
$error = $_GET['error'] ?? null;
require_once __DIR__ . '/View/Includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <h2 class="text-center">Iniciar Sesión</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">Usuario o contraseña incorrectos.</div>
        <?php endif; ?>

        <form action="Actions/verificarLogin.php" method="POST">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
            </div>
            <div class="mb-3">
                <label for="psw" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="psw" name="psw" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/View/Includes/footer.php'; ?>