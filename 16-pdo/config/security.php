<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['uid'])) {
    $_SESSION['error'] = "Por favor, inicie sesión para continuar";
    
    header("Location: ../index.php");
    exit(); 
}