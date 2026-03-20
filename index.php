<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Travel Destinations</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 text-gray-800">
        <?php
        session_start();
        $name = "";
        $userid = "";
        $is_session = isset($_SESSION["name"]) && isset($_SESSION["userid"]);

        if ($is_session) {
            $name = $_SESSION["name"];
            $userid = $_SESSION["userid"];
        }
        ?>
        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-teal-500 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">🌍 TravelCR</h1>
                <nav class="space-x-6 text-sm font-medium">
                    <a href="#" class="hover:text-yellow-300 transition">Welcome <?= $name ?></a>
                    <?php if ($is_session) { ?>
                        <a href="/book/my-books.php" class="hover:text-yellow-300 transition">My Books</a>
                    <?php } ?>
                    <a href="#" class="hover:text-yellow-300 transition">Promos</a>
                    <?php if (!$is_session) { ?>
                        <a data-bs-toggle="offcanvas" href="#offcanvasExample" class="hover:text-yellow-300 transition">Login</a>
                    <?php } else { ?>                   
                        <a data-bs-toggle="offcanvas" href="#offcanvasExample" class="hover:text-yellow-300 transition">My Profile</a>
                    <?php } ?>
                </nav>
            </div>
        </header>
        <!-- Hero -->
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-6 py-16 text-center">
                <h2 class="text-4xl font-bold mb-4">Discover incredible destinations</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore the best tourist spots with unique experiences, nature, culture, and adventure.</p>
            </div>
        </section>                

        <?php
        require_once __DIR__ . '/Database/connection.php';
        // 1. Preparamos la consulta SQL
        $stmt = $pdo->query("SELECT * FROM book;");
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Cards Section -->
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($books as $book): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                        <img src="<?= $book['photo'] ?>" alt="Playa" class="h-48 w-full object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?= $book['name'] ?></h3>
                            <p class="text-sm text-gray-600 mb-4"><?= $book['description'] ?></p>
                            <button 
                                onclick="window.location.href = 'book/book-details.php?id=<?= $book['id'] ?>'" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                                Book for $<?= $book['price'] ?>
                            </button>
                        </div>
                    </div>   
                <?php endforeach; ?>                                 
            </div>
        </section>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header bg-gradient-to-r from-blue-200 to-teal-500 text-white shadow-lg">
                <?php if (!$is_session) { ?>
                    <h5 class="mb-0">Log in</h5>
                <?php } ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body">
                <?php if (!$is_session) { ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="auth/validate-login.php">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="txtemail" placeholder="name@example.com" required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="txtpwd" placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } else { ?>
                    <div id="cardUser" class="mt-2">
                        <div class="card border-0 shadow-sm text-center" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                     alt="User avatar"
                                     class="rounded-circle mb-3"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                                <h5 id="lblName" class="fw-bold mb-1">
                                    <?= $name ?>
                                </h5>
                                <span class="badge bg-success mb-3">Online</span>
                                <hr>
                                <div class="list-group list-group-flush text-start mb-3">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        Profile
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        Settings
                                    </a>
                                </div>
                                <div class="d-grid">
                                    <button onclick="window.location.href = 'auth/logout.php'"
                                            id="btnLogout"
                                            type="button"
                                            class="btn btn-secondary">
                                        Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300">
            <div class="max-w-7xl mx-auto px-6 py-8 grid md:grid-cols-3 gap-6 text-sm">
                <div>
                    <h4 class="text-white font-semibold mb-2">TravelCR</h4>
                    <p>Your trusted guide to discovering the best travel destinations.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-2">Links</h4>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">Destinations</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-2">Contact</h4>
                    <p>Email: info@travelcr.com</p>
                    <p>Phone: +506 8000-0000</p>
                </div>
            </div>
            <div class="text-center text-xs text-gray-500 pb-4">© 2026 TravelCR. All rights reserved.</div>
        </footer>
    </body>
</html>