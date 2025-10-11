<?php

$tittle = "22 - Form Get";
$descripcion = "A simple form that uses the GET method to submit data";

include 'template/header.php';

echo '<section>';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    echo "<p>Hello, $name!</p>";
}
?>

<form method="get" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <input type="submit" value="Submit">
</form>

<?php
include 'template/footer.php';
?>
