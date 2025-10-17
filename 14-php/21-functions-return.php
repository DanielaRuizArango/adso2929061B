<?php

    $tittle = "21 - Functions Return";
    $descripcion = "functions that return a value after execution";

include 'template/header.php';
    echo '<section>';

    function calculateDivision($num1, $num2 = 5) {
        return "$num1 / $num2 equals: " . ($num1 / $num2). "<br>";
    }

    echo calculateDivision(4, 10);
    echo calculateDivision(6);
    echo calculateDivision(64, 4);

include 'template/footer.php'; ?>