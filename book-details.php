<?php
$id = htmlspecialchars($_GET['id']);

require 'Database/connection.php'; // Incluimos la conexión
// 1. Preparamos la consulta SQL
$stmt = $pdo->query("SELECT * FROM book WHERE id = $id");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
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
            td {
                width:90%
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

        <!-- Cards Section -->
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($books as $book): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform">
                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" alt="Playa" class="h-48 w-full object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($book['name']); ?></h3>
                            <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($book['description']); ?></p>                           
                            <h4>Book here this beautiful place for $ <label id="lbPrice"><?php echo htmlspecialchars($book['price']); ?></label> per night.</h4>
                        </div>
                    </div>   
                <?php endforeach; ?>   

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform">                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Make your reservation</h3>                        
                        <form>
                            <strong>Checkin</strong>
                            <div class="md:w-1/3">
                                <input class="form-control form-control-lg" 
                                       type="date"                                         
                                       id="dateIn"
                                       name="dateIn">
                            </div>
                            <br>
                            <hr>
                            <strong>Checkout</strong>
                            <div class="md:w-1/3">
                                <input class="form-control form-control-lg"                                         
                                       type="date" 
                                       id="dateOut"
                                       name="dateOut" >
                            </div>
                            <br>
                            <hr>
                            <div class="md:w-1/3">
                                <label id="nights"><label id="lbNights">3</label> nights</label>
                            </div>
                            <br>
                            <hr>
                            <div class="inline-block relative w-64">
                                <strong>Adults</strong>
                                <select id="selAdults" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>   
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div> 
                            <hr>
                            <br>
                            <div class="inline-block relative w-64">
                                <strong>Kids</strong>
                                <select id="selKids" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>       
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>   
                            <hr>
                            <br>
                            <div>
                                <p><strong>Additional charges</strong></p>
                                <table>                                   
                                    <tr>
                                        <td>Cleaning fee</td>                                         
                                        <td>$13</td>                                         
                                    </tr>
                                    <tr>
                                        <td>Room service</td>                                         
                                        <td>$10</td>                                         
                                    </tr>
                                    <tr>
                                        <td>Wifi</td>                                         
                                        <td>$5</td>                                         
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>$<label id="lbTotal"></label></strong></td>
                                    </tr>
                                </table>                          
                            </div>
                        </form>                        
                    </div>
                </div>   
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

        <script>
            function calculateNights() {
                let checkin = new Date(document.getElementById("dateIn").value);
                let checkout = new Date(document.getElementById("dateOut").value);

                if (checkin && checkout && checkin < checkout) {
                    let diff = (checkout - checkin) / (1000 * 60 * 60 * 24);
                    document.getElementById("lbNights").innerText = diff;
                } else {
                    document.getElementById("lbNights").innerText = 0;
                }

                calculateTotal();
            }

            function calculateTotal() {
                let price = parseFloat(document.getElementById("lbPrice").innerText);
                let nights = parseFloat(document.getElementById("lbNights").innerText);
                let adults = parseFloat(document.getElementById("selAdults").value);
                let kids = parseFloat(document.getElementById("selKids").value);

                let subtotal = (adults + kids) * nights * price;
                let tax = subtotal * 0.13;
                let total = subtotal + tax + 28;

                document.getElementById("lbTotal").innerText = total.toFixed(2);
            }

            calculateTotal();
            const today = new Date();
            const addedDays = 3;

            // Función para formatear fecha en yyyy-mm-dd
            const formatDate = (date) => date.toISOString().split('T')[0];

            // Crear nuevas fechas sin modificar la original
            const dateIn = new Date(today);
            const dateOut = new Date(today);
            const maxDate = new Date(today);

            dateOut.setDate(dateIn.getDate() + addedDays);
            maxDate.setDate(dateIn.getDate() + 30);

            // Asignaciones
            document.getElementById("dateIn").value = formatDate(dateIn);
            document.getElementById("dateIn").min = formatDate(dateIn);
            document.getElementById("dateOut").value = formatDate(dateOut);
            document.getElementById("dateOut").max = formatDate(maxDate);

            document.getElementById("dateIn").addEventListener("change", calculateNights);
            document.getElementById("dateOut").addEventListener("change", calculateNights);
            document.getElementById("selAdults").addEventListener("change", calculateTotal);
            document.getElementById("selKids").addEventListener("change", calculateTotal);
        </script>
    </body>
</html>


