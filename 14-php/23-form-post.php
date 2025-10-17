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

<style>
    .form-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 8px;
        background: #f9f9f9;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .form-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }
    
    .form-container input[type="text"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 2px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }
    
    .form-container input[type="text"]:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    }
    
    .submit-btn {
        background: #0056b3;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .submit-btn:hover {
        background: #004085;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .submit-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>

<div class="form-container">
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">
        <input type="submit" value="Submit" class="submit-btn">
    </form>
</div>

    <?php

    echo '</section>';

include 'template/footer.php'; ?>