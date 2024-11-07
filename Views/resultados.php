
<?php
// resultados.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: Login.php');
    exit();
}
require_once __DIR__ . '/../Controller/Resultados.php';
require_once __DIR__ . '/../conexion.php';

// Inicializar controladores
$database = new Database();
$db = $database->getConnection();
$resultadoController = new ResultadoController($db);

// Obtener resultados
$resultados = $resultadoController->getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Plataforma de Votaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include __DIR__ . '/../Layouts/Header.php'; ?>
<main class="container mx-auto mt-8 px-4">
    <section class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Resultados de las Votaciones</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Candidato</th>
                    <th class="py-2 px-4 border-b">Partido</th>
                    <th class="py-2 px-4 border-b">Votos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($resultado['nombre']); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($resultado['partido']); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($resultado['votos']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form method="post" action="generar_reporte.php">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Generar Reporte</button>
</form>
    </section>
</main>
<footer class="bg-gray-800 text-white p-4 mt-8 text-center">
    <p>&copy; 2023 Plataforma de Votaciones. Todos los derechos reservados.</p>
</footer>
</body>
</html>