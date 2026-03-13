<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require_once __DIR__ . '/../Database/connection.php';
    
    $email = htmlspecialchars($_POST['txtemail']);
    $pwd = htmlspecialchars($_POST['txtpwd']);

    try {
        $sql = "SELECT * FROM users WHERE email = ? AND status = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        if ($user) {
            if ($pwd == $user["pwd"]) {
                
                $_SESSION["name"] = $user["name"];
                $_SESSION["userid"] = $user["id"];
                
                header("Location: /../index.php");
                                
            } else {
                echo "Invalid user";
            }
        }
    } catch (PDOException $e) {
        echo "Error al insertar: " . $e->getMessage();
    }
}
