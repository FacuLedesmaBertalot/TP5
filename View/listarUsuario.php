<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Gestión de Usuarios</h1>
        <a href="ruta/a/tu/alta-usuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
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
                            // Lógica para mostrar el estado con "Badges" de Bootstrap
                            if ($usuario->usdeshabilitado) {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            } else {
                                echo '<span class="badge bg-success">Activo</span>';
                            }
                            ?>
                        </td>
                        <td class="text-end">
                            <a href="accion/actualizarLogin.php?id=<?php echo $usuario->idUsuario; ?>" class="btn btn-warning btn-sm">
                                Modificar
                            </a>
                            
                            <form method="POST" action="accion/eliminarLogin.php" class="d-inline ms-1" onsubmit="return confirm('¿Estás seguro de que quieres dar de baja a este usuario?');">
                                <input type="hidden" name="idUsuario" value="<?php echo $usuario->idUsuario; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Baja</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>