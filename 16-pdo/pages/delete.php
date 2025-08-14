<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';

    if($_GET && isset($_GET['id'])) {
         $id = $_GET['id'];

         if(deletePet($id, $conx)) {
            $_SESSION['message'] = "La mascota fue eliminada con éxito!";
            header("Location: dashboard.php");
            exit();
         } else {
            $_SESSION['error'] = "Error al eliminar la mascota";
            header("Location: dashboard.php");
            exit();
         }
    } else {
        $_SESSION['error'] = "ID de mascota no válido";
        header("Location: dashboard.php");
        exit();
    }
?>