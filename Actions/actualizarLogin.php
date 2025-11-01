<?php

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id) {
    header('Location: ../modificar-usuario.php?id=' . $id);
    exit;
} else {

    header('Location: /listar-usuarios.php');
}