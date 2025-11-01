<?php 
// 1. Incluimos el header. La variable $titulo debe ser definida 
//    en el script de entrada (ej: listar-usuarios.php) antes de llamar a este archivo.
require_once __DIR__ . '/Includes/header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Gestión de Usuarios</h1>
    <a href="/TP5/alta-usuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Estado</th>
                <th scope="col" class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($usuario->idUsuario); ?></th>
                    <td><?php echo htmlspecialchars($usuario->usnombre); ?></td>
                    <td><?php echo htmlspecialchars($usuario->usmail); ?></td>
                    <td>
                        <?php 
                        if ($usuario->usdeshabilitado) {
                            echo '<span class="badge bg-danger">Inactivo</span>';
                        } else {
                            echo '<span class="badge bg-success">Activo</span>';
                        }
                        ?>
                    </td>
                    <td class="text-end">
                        <form method="POST" action="/TP5/accion/procesarAccion.php" class="d-inline" onsubmit="return handleFormSubmit(this);">
                            <input type="hidden" name="idUsuario" value="<?php echo $usuario->idUsuario; ?>">
                            
                            <button type="submit" name="accion" value="modificar" class="btn btn-warning btn-sm">
                                Modificar
                            </button>
                            
                            <button type="submit" name="accion" value="baja" class="btn btn-danger btn-sm">
                                Baja
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function handleFormSubmit(form) {
    const action = document.activeElement.value;
    if (action === 'baja') {
        return confirm('¿Estás seguro de que quieres dar de baja a este usuario?');
    }
    return true;
}
</script>

<?php 
require_once __DIR__ . '/Includes/footer.php'; 
?>