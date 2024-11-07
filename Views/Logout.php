<?php

include_once '../Controller/Usuario.php';

$controller = new UsuarioController();

$controller->logout();

header('Location: Login.php');

?>

