<?php
$tittle = "32 - Exceptions";
$descripcion = "Handling errors and exceptions in PHP using try-catch blocks and custom exceptions";

include 'template/header.php';
?>

<section>
    <h3>Example 4: Custom Exception Class</h3>

    <?php
    // Custom exception
    class AgeException extends Exception {
        public function errorMessage() {
            return $this->getMessage();
        }
    }

    if (isset($_POST['age'])) {
        try {
            $age = (int)$_POST['age'];

            if ($age < 18) {
                throw new AgeException("You must be 18 or older!");
            } elseif ($age > 120) {
                throw new AgeException("Age seems unrealistic!");
            }

            echo "<p style='color: green;'>✓ Age $age is valid!</p>";

        } catch (AgeException $e) {
            echo "<p style='color: red;'>✗ " . $e->errorMessage() . "</p>";
        }
    }
    ?>

    <form method="post" action="">
        <label for="age">Enter your age:</label>
        <input type="number" name="age" id="age" required min="1" max="150">
        <input type="submit" value="Validate Age">
    </form>
</section>

<?php include 'template/footer.php'; ?>
