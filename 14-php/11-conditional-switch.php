<?php
$tittle = "11- Conditional SWITCH";
$descripcion = "Perform conditional operations on variables";
// Variable con una calificación
$calificacion = "5";
include 'template/header.php';
    echo '<section>';

echo "<h2>Ejemplo de Switch en PHP</h2>";
echo "<p>Calificación obtenida: <strong>$calificacion</strong></p>";

// Condicional switch
switch ($calificacion) {
    case "5":
        echo "<p>Excelente.</p>";
        break;
    case "4":
        echo "<p>Sobresaliente.</p>";
        break;
    case "3":
        echo "<p>Bien.</p>";
        break;
    case "2":
        echo "<p>Regular</p>";
        break;
    case "1":
        echo "<p>Reprobado</p>";
        break;
    default:
        echo "<p>Calificación no válida.</p>";
}
?>
<?php

include 'template/footer.php'; ?>
