<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Destinos Turísticos</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 text-gray-800">
        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-teal-500 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">🌍 TravelCR</h1>
                <nav class="space-x-6 text-sm font-medium">
                    <a href="#" class="hover:text-yellow-300 transition">Inicio</a>
                    <a href="#" class="hover:text-yellow-300 transition">Destinos</a>
                    <a href="#" class="hover:text-yellow-300 transition">Paquetes</a>
                    <a href="#" class="hover:text-yellow-300 transition">Contacto</a>
                </nav>
            </div>
        </header>
        <!-- Hero -->
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-6 py-16 text-center">
                <h2 class="text-4xl font-bold mb-4">Descubre destinos increíbles</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explora los mejores lugares turísticos con experiencias únicas, naturaleza, cultura y aventura.</p>
            </div>
        </section>                

        <?php
        require 'Database/connection.php'; // Incluimos la conexión
        // 1. Preparamos la consulta SQL
        $stmt = $pdo->query("SELECT * FROM book;");
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Cards Section -->
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($books as $book): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" alt="Playa" class="h-48 w-full object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($book['name']); ?></h3>
                            <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($book['description']); ?></p>
                            <button 
                                onclick="window.location.href='book-details.php?id=<?php echo $book['id'];?>'" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                                    Book for $<?php echo htmlspecialchars($book['price']); ?>
                            </button>
                        </div>
                    </div>   
                <?php endforeach; ?>                                 
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300">
            <div class="max-w-7xl mx-auto px-6 py-8 grid md:grid-cols-3 gap-6 text-sm">
                <div>
                    <h4 class="text-white font-semibold mb-2">TravelCR</h4>
                    <p>Tu guía confiable para descubrir los mejores destinos turísticos.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-2">Enlaces</h4>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:text-white">Inicio</a></li>
                        <li><a href="#" class="hover:text-white">Destinos</a></li>
                        <li><a href="#" class="hover:text-white">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-2">Contacto</h4>
                    <p>Email: info@travelcr.com</p>
                    <p>Tel: +506 8000-0000</p>
                </div>
            </div>
            <div class="text-center text-xs text-gray-500 pb-4">© 2026 TravelCR. Todos los derechos reservados.</div>
        </footer>
    </body>
</html>