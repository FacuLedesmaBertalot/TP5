<?php 
require_once __DIR__ . '/../Includes/header.php'; 
?>

<div class="container mt-5" style="max-width: 600px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Modificar Usuario</h1>
        <a href="listar-usuarios.php" class="btn btn-secondary">Volver al Listado</a>
    </div>

    <hr>

    <?php 
    // Mostramos las alertas de validación que vienen del Controlador
    if (!empty($alertas)) {
        foreach ($alertas['error'] as $alerta) {
            echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($alerta) . '</div>';
        }
    }
    ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/TP5/modificar-usuario.php" method="POST">
                
                <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario->idUsuario); ?>">

                <div class="mb-3">
                    <label for="usnombre" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="usnombre" name="usnombre" 
                           value="<?php echo htmlspecialchars($usuario->usnombre); ?>">
                </div>
                
                <div class="mb-3">
                    <label for="usmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="usmail" name="usmail"
                           value="<?php echo htmlspecialchars($usuario->usmail); ?>">
                </div>

                <div class="mb-3">
                    <label for="uspass" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="uspass" name="uspass">
                    <div class="form-text">Dejar en blanco si no deseas cambiar la contraseña.</div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php 
require_once __DIR__ . '/../Includes/footer.php'; 
?>