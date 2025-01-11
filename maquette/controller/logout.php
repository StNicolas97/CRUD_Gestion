<?php
// logout.php

session_start(); // Démarrer la session

// Détruire toutes les variables de session
$_SESSION = array();

// Si vous utilisez des cookies pour la session, les supprimer également
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

session_unset();
// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil ou de connexion
header("Location: ../index.php");
exit();
?>
