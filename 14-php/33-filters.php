<?php

    $tittle = "33 - Filters";
    $descripcion = "Validating and sanitizing user input using PHP filter functions";

include 'template/header.php';
    echo '<section>';

    echo "<h3>Example 1: Email Validation & Sanitization</h3>";
    
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        
        echo "<p><strong>Original email:</strong> " . htmlspecialchars($email) . "</p>";
        
        // Sanitize email
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        echo "<p><strong>Sanitized email:</strong> $sanitizedEmail</p>";
        
        // Validate email
        if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color: green;'>✓ Valid email address!</p>";
        } else {
            echo "<p style='color: red;'>✗ Invalid email address!</p>";
        }
    }
    
    ?>

    <form method="post" action="">
        <label for="email">Email Address:</label>
        <input type="text" name="email" id="email" placeholder="test@example.com" required>
        <input type="submit" value="Validate Email">
    </form>

    <?php

    echo "<h3>Example 2: Integer Validation</h3>";
    
    if (isset($_POST['number'])) {
        $number = $_POST['number'];
        
        echo "<p><strong>Input:</strong> " . htmlspecialchars($number) . "</p>";
        
        // Validate integer
        if (filter_var($number, FILTER_VALIDATE_INT)) {
            echo "<p style='color: green;'>✓ Valid integer!</p>";
        } else {
            echo "<p style='color: red;'>✗ Not a valid integer!</p>";
        }
        
        // Validate integer with range
        $options = [
            'options' => [
                'min_range' => 1,
                'max_range' => 100
            ]
        ];
        
        if (filter_var($number, FILTER_VALIDATE_INT, $options)) {
            echo "<p style='color: green;'>✓ Number is between 1 and 100!</p>";
        } else {
            echo "<p style='color: red;'>✗ Number must be between 1 and 100!</p>";
        }
    }
    
    ?>

    <form method="post" action="">
        <label for="number">Enter a number (1-100):</label>
        <input type="text" name="number" id="number" placeholder="42" required>
        <input type="submit" value="Validate Number">
    </form>

    <?php

    echo "<h3>Example 3: URL Validation & Sanitization</h3>";
    
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        
        echo "<p><strong>Original URL:</strong> " . htmlspecialchars($url) . "</p>";
        
        // Sanitize URL
        $sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);
        echo "<p><strong>Sanitized URL:</strong> $sanitizedUrl</p>";
        
        // Validate URL
        if (filter_var($sanitizedUrl, FILTER_VALIDATE_URL)) {
            echo "<p style='color: green;'>✓ Valid URL!</p>";
            echo "<p><a href='$sanitizedUrl' target='_blank'>Visit URL</a></p>";
        } else {
            echo "<p style='color: red;'>✗ Invalid URL!</p>";
        }
    }
    
    ?>

    <form method="post" action="">
        <label for="url">Website URL:</label>
        <input type="text" name="url" id="url" placeholder="https://example.com" required>
        <input type="submit" value="Validate URL">
    </form>

    <?php

    echo "<h3>Example 4: Sanitizing Strings (XSS Prevention)</h3>";
    
    if (isset($_POST['text'])) {
        $text = $_POST['text'];
        
        echo "<p><strong>Original text:</strong> " . htmlspecialchars($text) . "</p>";
        
        // Alternative: htmlspecialchars (recommended)
        $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        echo "<p><strong>Sanitized text:</strong> $safeText</p>";
        
        // Strip tags completely
        $strippedText = strip_tags($text);
        echo "<p><strong>Stripped tags:</strong> $strippedText</p>";
    }
    
    ?>

    <form method="post" action="">
        <label for="text">Enter text (try with HTML tags):</label><br>
        <textarea name="text" id="text" rows="3" cols="50" placeholder="Try: <script>alert('XSS')</script>" required></textarea>
        <br>
        <input type="submit" value="Sanitize Text">
    </form>

    <?php

    echo "<h3>Example 5: Multiple Filter Tests</h3>";
    
    $testData = [
        'email' => 'test@example.com',
        'invalid_email' => 'not-an-email',
        'url' => 'https://www.google.com',
        'invalid_url' => 'not a url',
        'integer' => '42',
        'float' => '3.14',
        'boolean' => 'true',
        'ip' => '192.168.1.1'
    ];
    
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr><th>Data</th><th>Type</th><th>Valid?</th></tr>";
    
    foreach ($testData as $key => $value) {
        echo "<tr>";
        echo "<td><strong>$key:</strong> $value</td>";
        
        if (strpos($key, 'email') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_EMAIL);
            echo "<td>EMAIL</td>";
        } elseif (strpos($key, 'url') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_URL);
            echo "<td>URL</td>";
        } elseif (strpos($key, 'integer') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_INT);
            echo "<td>INTEGER</td>";
        } elseif (strpos($key, 'float') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_FLOAT);
            echo "<td>FLOAT</td>";
        } elseif (strpos($key, 'boolean') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            echo "<td>BOOLEAN</td>";
        } elseif (strpos($key, 'ip') !== false) {
            $isValid = filter_var($value, FILTER_VALIDATE_IP);
            echo "<td>IP ADDRESS</td>";
        } else {
            $isValid = null;
            echo "<td>-</td>";
        }
        
        if ($isValid !== false && $isValid !== null) {
            echo "<td style='color: green;'>✓ Valid</td>";
        } else {
            echo "<td style='color: red;'>✗ Invalid</td>";
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
include 'template/footer.php'; ?>