<?php

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id) {
    header('Location: /');
    exit;
} else {

    header('Location: /../View/listarUsuario.php');
}