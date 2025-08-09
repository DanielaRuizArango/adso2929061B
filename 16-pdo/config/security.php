<?php
    if(!isset($_SESSION['uid'])) {
        $_SESSION['error'] = "Por favor, Inicie Sesión";
        echo "<script>
                window.location.replace('../index.php')
             </script>";
    }