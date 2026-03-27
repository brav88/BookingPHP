<?php
session_start();

$is_session = isset($_SESSION["name"]) && isset($_SESSION["userid"]);

if ($is_session) {
    require_once __DIR__ . '/../Database/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = htmlspecialchars($_GET['id']);
        $userid = $_SESSION["userid"];
        
        try {
            $sql = "UPDATE reservation SET status = 0 WHERE id = ? AND idUser = ?";

            //$sql = "DELETE FROM reservation WHERE id = ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([$id, $userid]);
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
        }
    }
} else {
    header("Location: /../index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Canceled</title>
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
                <div class="success">Reservation canceled!</div>                
                <br>
                <a href="my-books.php" class="btn">Back to my Books</a>
            </div>
        </div>
    </body>
</html>









