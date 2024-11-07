<?php
session_start();
require_once __DIR__ . '/../Controller/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $result = $controller->login($_POST['email'], $_POST['password']);
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        //borramos el error si existe
        unset($_SESSION['error']);
        
        header('Location: ../index.php');
    } else {
        $_SESSION['error'] = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Plataforma de Votaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include "../Layouts/Header.php"; ?>
    <main class="container mx-auto mt-8 px-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6 text-center">Iniciar Sesión</h2>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">';
                echo '<strong class="font-bold">Error!</strong>';
                echo '<span class="block sm:inline">' . $_SESSION['error'] . '</span>';
                echo '</div>';
                unset($_SESSION['error']);
            }
            ?>





            <form action="Login.php" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-gray-700 mb-2">Correo electrónico</label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Iniciar Sesión
                </button>
            </form>
            <p class="mt-4 text-center text-gray-600">
                ¿No tienes una cuenta? 
                <a href="Register.php" class="text-blue-600 hover:underline">Regístrate</a>
            </p>
        </div>
    </main>
    <footer class="bg-gray-800 text-white p-4 mt-8 text-center">
        <p>&copy; 2023 Plataforma de Votaciones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>