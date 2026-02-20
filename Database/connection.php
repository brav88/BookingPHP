<?php
    $host = 'localhost';
    $db   = 'Booking';    // <--- Cambia esto
    $user = 'root';       // Usuario por defecto
    $pass = 'Admin$1234'; // Tu contraseña de MySQL
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";
    
    try {
        // Creamos la conexión PDO
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
