
<?php
$tittle = '13- Arrays Associative';
$description = 'Array using string keys to access corresponding value';

include 'template/header.php';

echo "<section>";

$characters = array(
    'Tanjiro Kamado' => 16,
    'Nezuko Kamado' => 15,
    'Zenitsu Agatsuma' => 17,
    'Inosuke Hashibira' => 18,
);

$characters['Genya Shinazugawa'] = 20;
$characters['Kanao Tsuyuri'] = 19;

//var_dump($characters);

foreach ($characters as $key => $value) {
    echo $key . ":" . $value . "<br>";
}

include 'template/footer.php';