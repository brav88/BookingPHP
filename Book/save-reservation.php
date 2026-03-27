<?php
session_start();

$is_session = isset($_SESSION["name"]) && isset($_SESSION["userid"]);

if ($is_session) {
    $userid = $_SESSION["userid"];

    require_once __DIR__ . '/../Database/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resId = (int) htmlspecialchars($_POST['resId']);
        $idBook = htmlspecialchars($_POST['idBook']);
        $dateIn = htmlspecialchars($_POST['dateIn']);
        $dateOut = htmlspecialchars($_POST['dateOut']);
        $selAdults = htmlspecialchars($_POST['selAdults']);
        $selKids = htmlspecialchars($_POST['selKids']);
        $txtTotal = htmlspecialchars($_POST['txtTotal']);

        try {
            if ($resId > 0) {
                $sql = "UPDATE reservation SET checkin = ?, checkout = ?, adults = ?,kids = ?, total = ? WHERE id = ?;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$dateIn, $dateOut, $selAdults, $selKids, $txtTotal, $resId]);
            } else {
                $sql = "INSERT INTO `booking`.`reservation` (`idUser`,`idBook`,`checkin`,`checkout`,`adults`,`kids`,`total`,`status`,`created`)VALUES(?,?,?,?,?,?,?,?,LOCALTIME());";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$userid, $idBook, $dateIn, $dateOut, $selAdults, $selKids, $txtTotal, 1]);
            }
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Complete</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.6);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .modal {
                background: white;
                padding: 35px;
                border-radius: 10px;
                width: 400px;
                text-align: center;
                animation: fadeIn 0.4s ease;
            }

            @keyframes fadeIn {
                from {
                    transform: scale(0.8);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            .success {
                font-size: 22px;
                color: #2e7d32;
                margin-bottom: 15px;
            }

            .modal p {
                margin: 8px 0;
            }
        </style>
    </head>
    <body>
        <div class="modal-overlay">
            <div class="modal">
                <div class="success">✅ Reservation Confirmed!</div>                
                <br>
                <a href="/../index.php" class="btn">Back to Home</a>
            </div>
        </div>
    </body>
</html>









