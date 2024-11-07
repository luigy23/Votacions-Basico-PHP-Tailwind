<?php
// votar.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: Views/Login.php');
    exit();
}

require_once __DIR__ . '/../../Controller/Candidato.php';
require_once __DIR__ . '/../../Controller/Voto.php';
require_once __DIR__ . '/../../conexion.php';

// Initialize controllers
$database = new Database();
$db = $database->getConnection();

$candidatoController = new CandidatoController();
$votoController = new VotoController($db);

// Fetch candidates
$candidatos = $candidatoController->getAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $votoController->castVote($_SESSION['user_id'], $_POST['candidato_id']);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }
    header('Location: votar.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Votar - Plataforma de Votaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php include __DIR__ . '/../../Layouts/Header.php'; ?>

<main class="container mx-auto mt-8 px-4">
    <section class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Elige tu Candidato</h2>

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

        <form action="votar.php" method="POST" class="space-y-4">
            <?php foreach ($candidatos as $candidato): ?>
                <div>
                    <input type="radio" id="candidato_<?php echo $candidato['id']; ?>" name="candidato_id" value="<?php echo $candidato['id']; ?>" required>
                    <label for="candidato_<?php echo $candidato['id']; ?>" class="ml-2">
                        <?php echo htmlspecialchars($candidato['nombre']); ?>
                    </label>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Votar
            </button>
        </form>
    </section>
</main>


</body>
</html>