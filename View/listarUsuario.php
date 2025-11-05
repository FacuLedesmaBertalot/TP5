<?php require_once __DIR__ . '/Includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Gestión de Usuarios</h1>
    <a href="/TP5/alta-usuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario->idUsuario); ?></td>
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
                        <a href="Actions/actualizarLogin.php?id=<?php echo $usuario->idUsuario; ?>" class="btn btn-warning btn-sm">Modificar</a>
                        
                        <form method="POST" action="/TP5/eliminar-usuario.php" class="d-inline ms-1" onsubmit="return confirm('¿Estás seguro?');">
                            <input type="hidden" name="idUsuario" value="<?php echo $usuario->idUsuario; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/Includes/footer.php'; ?>