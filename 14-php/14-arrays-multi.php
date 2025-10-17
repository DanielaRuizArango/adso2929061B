<?php
$tittle = '14- Arrays Multidimensional.php';
$descripcion = 'Arrays that contain other nested arrays';

include 'template/header.php';

echo "<section>";

$bicycles = array(
    'Specialized' => array('Enduro', 'Stumpjumper', 'Camber'),
    'Intense' => array('Dirt', 'Cross', 'Rally'),
    'Santa Cruz' => array('Hightroad', 'Nomad', 'Blade'),
);

//var_dump($bicycles);

foreach ($bicycles as $key => $value ) {
    echo "<h3>$key</h3>";
    echo "<ul>";
    foreach ($value as $refer) {
        echo "<li>$refer</li>";
    }
    echo "</ul>";
}

echo "</section>";

include 'template/footer.php';
?>