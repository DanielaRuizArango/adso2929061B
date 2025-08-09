<?php
    if(isset($_SESSION['uid'])) {
        echo "<script> window.location.replace('pages/dashboard.php') </script>";
    }