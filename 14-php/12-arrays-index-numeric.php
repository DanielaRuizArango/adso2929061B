<?php

    $tittle = "12 - Arrays Index Numeric";
    $descripcion = "Learn about numeric indexed arrays";

include 'template/header.php';
    echo '<section>';

    $animales = ["Perro", "Gato", "Loro"];
            echo "<h5>Array original:</h5>";
            echo "<pre>";
            print_r($animales);
            echo "</pre>";
     $animales[] = "Pez";
     array_push($animales, "Hamster");

     $animales[1] = "Gato Persa";
     
     echo "<h5>Array después de modificaciones:</h5>";
     echo "<pre>";
     print_r($animales);
     echo "</pre>"
?>
<?php

include 'template/footer.php'; ?>
