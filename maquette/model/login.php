<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Fonction pour valider les entrées
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($username);
    $password = validate($password);

    if (empty($username)) {
        header("Location: ../index.php?error=User Name is required");
        exit();
    } else if (empty($password)) {
        header("Location: ../index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE user_name = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['id'] = $user['id'];
            header("Location: ../view/header.php");
            exit();
        } else {
            header("Location: ../index.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
