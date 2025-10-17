<?php

    $tittle = "20 - Functions With Params";
    $descripcion = "A function that accepts input values to perform its specific task";

include 'template/header.php';
    echo '<section>';

    function calculateProduct($num1, $num2 = 5) {
        echo "$num1 * $num2 equals: " . ($num1 * $num2). "<br>";
    }

    calculateProduct(4, 10);
    calculateProduct(6);

include 'template/footer.php'; 