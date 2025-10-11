<?php

    $tittle = "32 - Exceptions";
    $descripcion = "Handling errors and exceptions in PHP using try-catch blocks and custom exceptions";

include 'template/header.php';
    echo '<section>';


    echo "<h3>Example 1: Basic Try-Catch</h3>";
    
    try {
        $number = 10;
        $divisor = 0;
        
        if ($divisor == 0) {
            throw new Exception("Division by zero is not allowed!");
        }
        
        $result = $number / $divisor;
        echo "<p>Result: $result</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error caught: " . $e->getMessage() . "</p>";
    }

    echo "<h3>Example 2: Multiple Catch Blocks</h3>";
    
    try {
        if (isset($_GET['test'])) {
            $test = $_GET['test'];
            
            if ($test == "invalid") {
                throw new InvalidArgumentException("Invalid argument provided!");
            } elseif ($test == "runtime") {
                throw new RuntimeException("Runtime error occurred!");
            } elseif ($test == "logic") {
                throw new LogicException("Logic error detected!");
            }
            
            echo "<p style='color: green;'>✓ No errors! Test value: $test</p>";
        }
        
    } catch (InvalidArgumentException $e) {
        echo "<p style='color: red;'>✗ Invalid Argument: " . $e->getMessage() . "</p>";
    } catch (RuntimeException $e) {
        echo "<p style='color: red;'>✗ Runtime Error: " . $e->getMessage() . "</p>";
    } catch (LogicException $e) {
        echo "<p style='color: red;'>✗ Logic Error: " . $e->getMessage() . "</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ General Error: " . $e->getMessage() . "</p>";
    }
    
    ?>

    <p>Test different exceptions:</p>
    <a href="?test=invalid" style="padding: 5px 10px; background: #dc3545; color: white; text-decoration: none; margin: 5px;">Invalid Argument</a>
    <a href="?test=runtime" style="padding: 5px 10px; background: #fd7e14; color: white; text-decoration: none; margin: 5px;">Runtime Error</a>
    <a href="?test=logic" style="padding: 5px 10px; background: #ffc107; color: black; text-decoration: none; margin: 5px;">Logic Error</a>
    <a href="?test=success" style="padding: 5px 10px; background: #28a745; color: white; text-decoration: none; margin: 5px;">Success</a>

    <?php

    echo "<h3>Example 3: Finally Block</h3>";
    echo "<p>The finally block always executes, whether an exception occurs or not.</p>";
    
    try {
        echo "<p>Opening database connection...</p>";
        
        if (rand(0, 1)) {
            throw new Exception("Database connection failed!");
        }
        
        echo "<p style='color: green;'>✓ Database query executed successfully</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ " . $e->getMessage() . "</p>";
    } finally {
        echo "<p><em>Closing database connection (this always runs)</em></p>";
    }

    echo "<h3>Example 4: Custom Exception Class</h3>";
    
    // Define custom exception
    class AgeException extends Exception {
        public function errorMessage() {
            return "Error on line " . $this->getLine() . " in " . $this->getFile() . ": " . $this->getMessage();
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

    <?php

    echo "<h3>Example 5: File Operations with Exceptions</h3>";
    
    try {
        $filename = "nonexistent.txt";
        
        if (!file_exists($filename)) {
            throw new Exception("File '$filename' not found!");
        }
        
        $content = file_get_contents($filename);
        echo "<p>$content</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ " . $e->getMessage() . "</p>";
        echo "<p>Creating default file content instead...</p>";
    }
include 'template/footer.php'; ?>