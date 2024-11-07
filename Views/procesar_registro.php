<?php
// procesar_registro.php
require_once __DIR__ . '/../Controller/Usuario.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    
    // Validate password confirmation
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['error'] = 'Las contraseñas no coinciden';
        header('Location: Register.php');
        exit();

    }

    // Process registration
    $result = $controller->register([
        'nombre' => $_POST['nombre'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

    if ($result['success']) {
        $_SESSION['success'] = $result['message']; 
        header('Location: Register.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: Register.php');
    }
    exit();
}