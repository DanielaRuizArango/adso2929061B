<?php

    $tittle = "23 - Form Post";
    $descripcion = "A simple form that uses the POST method to submit data";

include 'template/header.php';
    echo '<section>';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        echo "<p>Hello, $name!</p>";
    }

    ?>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Submit">
    </form>

    <?php

    echo '</section>';

include 'template/footer.php'; ?>