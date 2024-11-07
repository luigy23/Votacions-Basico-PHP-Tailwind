<?php
session_start();
require_once __DIR__ . '/../../Controller/Usuario.php';
require_once __DIR__ . '/../../Model/Usuario.php';
require_once __DIR__ . '/../../conexion.php';
require_once __DIR__ . '/../../Model/Candidato.php';

if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    header('Location: ../../index.php');
    exit();
}

$database = new Database();
$db = $database->getConnection();
$candidatoModel = new CandidatoModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $candidatoModel->nombre = $_POST['nombre'];
                $candidatoModel->descripcion = $_POST['descripcion'];
                $candidatoModel->partido = $_POST['partido'];
                if ($candidatoModel->crear()) {
                    $_SESSION['success'] = 'Candidato creado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al crear candidato';
                }
                break;
            case 'update':
                $candidatoModel->id = $_POST['id'];
                $candidatoModel->nombre = $_POST['nombre'];
                $candidatoModel->descripcion = $_POST['descripcion'];
                $candidatoModel->partido = $_POST['partido'];
                if ($candidatoModel->actualizar()) {
                    $_SESSION['success'] = 'Candidato actualizado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al actualizar candidato';
                }
                break;
            case 'delete':
                $candidatoModel->id = $_POST['id'];
                if ($candidatoModel->eliminar()) {
                    $_SESSION['success'] = 'Candidato eliminado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al eliminar candidato';
                }
                break;
        }
    }
    header('Location: candidatos.php');
    exit();
}

$candidatos = $candidatoModel->leerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Candidatos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include __DIR__ . '/../../Layouts/Header.php'; ?>
    <main class="container mx-auto mt-8 px-4">
        <section class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Administrar Candidatos</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            <form action="candidatos.php" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="create">
                <div>
                    <label for="nombre" class="block text-gray-700 mb-2">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="descripcion" class="block text-gray-700 mb-2">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div>
                    <label for="partido" class="block text-gray-700 mb-2">Partido</label>
                    <input type="text" id="partido" name="partido" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Crear Candidato</button>
            </form>
            <h3 class="text-xl font-semibold mt-8 mb-4">Lista de Candidatos</h3>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Descripción</th>
                        <th class="py-2 px-4 border-b">Partido</th>
                        <th class="py-2 px-4 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidatos as $candidato): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($candidato['nombre']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($candidato['descripcion']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($candidato['partido']); ?></td>
                            <td class="py-2 px-4 border-b">
                                <button onclick="editarCandidato(<?php 
                                    echo htmlspecialchars(json_encode([
                                        'id' => $candidato['id'],
                                        'nombre' => $candidato['nombre'],
                                        'descripcion' => $candidato['descripcion'],
                                        'partido' => $candidato['partido']
                                    ])); 
                                ?>)" class="text-blue-600 hover:underline">Editar</button>
                                <script>
                                function editarCandidato(candidato) {
                                    document.querySelector('input[name="action"]').value = 'update';
                                    document.querySelector('input[name="nombre"]').value = candidato.nombre;
                                    document.querySelector('textarea[name="descripcion"]').value = candidato.descripcion;
                                    document.querySelector('input[name="partido"]').value = candidato.partido;
                                    document.querySelector('form').insertAdjacentHTML('beforeend', 
                                        `<input type="hidden" name="id" value="${candidato.id}">`);
                                    document.querySelector('button[type="submit"]').textContent = 'Actualizar Candidato';
                                }
                                </script>
                                <form action="candidatos.php" method="POST" class="inline-block">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $candidato['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer class="bg-gray-800 text-white p-4 mt-8 text-center">
        <p>&copy; 2023 Plataforma de Votaciones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>