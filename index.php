<?php
// index.php

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Votaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include __DIR__ . '/Layouts/Header.php'; ?>

    <main class="container mx-auto mt-8">
        <section class="bg-white p-6 rounded-lg shadow-lg">
            <?php if (isset($_SESSION['user_name'])): ?>
                <h2 class="text-2xl font-semibold mb-4">Bienvenid@, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                <p class="mb-4">Gracias por iniciar sesión. Puedes comenzar a votar.</p>
                <a href="/clase-php/Proyecto/Views/votaciones/votar.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Comenzar a Votar</a>
            <?php else: ?>
                <h2 class="text-2xl font-semibold mb-4">Bienvenido a la Plataforma de Votaciones</h2>
                <p class="mb-4">Aquí puedes votar por tus candidatos favoritos de manera fácil y segura.</p>
                <a href="Views/Register.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Registrarse</a>
                <a href="Views/Login.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">Iniciar Sesión</a>
            <?php endif; ?>
        </section>
        <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
            <section class="mt-4 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Panel de Administración</h2>
            <p class="mb-4">Como
                administrador, puedes ver los resultados de las votaciones y administrar los candidatos.</p>
            <a href="/clase-php/Proyecto/Views/resultados.php"
                 class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ver Resultados</a>
            <a href="/clase-php/Proyecto/Views/admin/candidatos.php"
                class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">Administrar Candidatos</a>
            </section>
        <?php endif; ?>



    </main>
    <footer class="bg-gray-800 text-white p-4 mt-8 text-center">
        <p>&copy; 2023 Plataforma de Votaciones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>