<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>My Destinations</title>
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

            require_once __DIR__ . '/../Database/connection.php';

            $sql = " SELECT ";
            $sql .= " r.id,";
            $sql .= " r.checkin,";
            $sql .= " r.checkout,";
            $sql .= " r.adults,";
            $sql .= " r.kids,";
            $sql .= " r.total,";
            $sql .= " b.name, ";
            $sql .= " b.photo";
            $sql .= " FROM reservation r";
            $sql .= " INNER JOIN book b";
            $sql .= " ON r.idBook = b.id";
            $sql .= " WHERE r.idUser = $userid";
            $sql .= " AND r.status = 1";

            $stmt = $pdo->query($sql);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            header("Location: /../index.php");
        }
        ?>

        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-teal-500 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold"><a href="/../index.php">🌍 TravelCR</a></h1>
                <nav class="space-x-6 text-sm font-medium">
                    <a href="/../index.php" class="hover:text-yellow-300 transition">Home</a>
                    <a href="#" class="hover:text-yellow-300 transition">Offers</a>
                    <a href="#" class="hover:text-yellow-300 transition">Promos</a>                  
                </nav>
            </div>
        </header>

        <!-- Cards Section -->
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($reservations as $reservation): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                        <img src="<?= $reservation['photo'] ?>" alt="Playa" class="h-48 w-full object-cover">
                        <div class="p-6">                                                      
                            <h3 class="text-xl font-semibold mb-2"><?= $reservation['name'] ?></h3>    
                            <table class="table">
                                <tr>
                                    <td>
                                        Checkin: <p class="text-sm text-gray-600 mb-4"><?= $reservation['checkin'] ?></p> 
                                    </td>
                                    <td>
                                        Checkout: <p class="text-sm text-gray-600 mb-4"><?= $reservation['checkout'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Adults: <p class="text-sm text-gray-600 mb-4"><?= $reservation['adults'] ?></p>
                                    </td>
                                    <td>
                                        Kids: <p class="text-sm text-gray-600 mb-4"><?= $reservation['kids'] ?></p> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total: <p class="text-xl font-semibold mb-2">$<?= $reservation['total'] ?></p>    
                                    </td>
                                </tr>
                            </table>                                
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal"
                                    data-id="<?= $reservation['id'] ?>">Cancel</button>
                        </div>
                    </div>   
                <?php endforeach; ?>                                 
            </div>                      
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel reservation?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this book?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button id="btnCancel" type="button" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            document.getElementById("exampleModal").addEventListener("show.bs.modal",
                    function (event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-id');

                        const btnCancel = document.getElementById('btnCancel');

                        btnCancel.onclick = function () {
                            window.location.href = "cancel-reservation.php?id=" + id;
                        };
                    });
        </script>

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