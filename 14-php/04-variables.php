<?php

    $tittle = "04 - Variables";
    $descripcion = "How to assing values";

include 'template/header.php';
    echo '<section>';

    $num1 = 25.6;
    $num2 = 4;

    $string1 = "This is a ";
    $string2 = "string value ";

    echo "<p>$num1 + $num2 = " . ($num1 + $num2) . "</p>";
    echo "<p>$string1 $string2</p>";
    echo "<p>" . $string1 .' '. $string2 . "</p>";

include 'template/footer.php';
