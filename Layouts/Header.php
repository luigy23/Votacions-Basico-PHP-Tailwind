<header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">Plataforma de Votaciones</h1>

            <nav class="mt-4">
                <ul class="flex space-x-4">
                    <li>
                        <a href="/clase-php/Proyecto/index.php" class="hover:underline">Inicio</a>
                    </li>
                    <li>
                        <a href="/clase-php/Proyecto/Views/votaciones/votar.php" class="hover:underline">Votar</a>
                    </li>
                    <li>
                        <a href="/clase-php/Proyecto/Views/resultados.php" class="hover:underline">Resultados</a>
                    </li>
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <li>
                            <a href="/clase-php/Proyecto/Views/Logout.php" class="hover:underline">Cerrar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

        </div>
    </header>