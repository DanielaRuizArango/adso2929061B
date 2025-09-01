<?php

    $tittle = "04 - Variables";
    $descripcion = "How to assing values";

include 'template/header.php';
    echo '<section>';

    $string1 = "Lorem ipsum dolor ";
    $string2 = "sit amet consectetur...";

    echo "<p>" . $string1 .' '. $string2 . "</p>";
    echo "Character length: " . strlen($string1 . $string2);
    echo '<br>';
    echo "Position if ADSO into Hello ADSO: " . strpos('Hello ADSO', 'ADSO');
    echo '<br>';
    echo "Last 5 words of Visualization: " . substr('Visualization', -5);


include 'template/footer.php';
