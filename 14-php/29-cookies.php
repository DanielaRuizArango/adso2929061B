<?php

    $tittle = "29 - Cookies";
    $descripcion = "Working with cookies in PHP to store user data on the client side";

    // Process cookie actions BEFORE any HTML output
    if (isset($_POST['setCookie'])) {
        $cookieName = htmlspecialchars($_POST['cookieName']);
        $cookieValue = htmlspecialchars($_POST['cookieValue']);
        $cookieDays = (int)$_POST['cookieDays'];
        
        // Set cookie (expires in X days)
        $expiry = time() + ($cookieDays * 24 * 60 * 60);
        setcookie($cookieName, $cookieValue, $expiry, "/");
        
        $successMessage = "Cookie '$cookieName' set successfully! (Expires in $cookieDays days)";
    }

    if (isset($_POST['deleteCookie'])) {
        $cookieName = htmlspecialchars($_POST['deleteCookieName']);
        
        // Delete cookie by setting expiry in the past
        setcookie($cookieName, "", time() - 3600, "/");
        
        $deleteMessage = "Cookie '$cookieName' has been deleted!";
    }

include 'template/header.php';
    echo '<section>';

    // Display messages
    if (isset($successMessage)) {
        echo "<p style='color: green;'>✓ $successMessage</p>";
        echo "<p><small>Note: Refresh the page to see the cookie in the list below.</small></p>";
    }
    
    if (isset($deleteMessage)) {
        echo "<p style='color: orange;'>✓ $deleteMessage</p>";
        echo "<p><small>Note: Refresh the page to see changes.</small></p>";
    }

    echo "<h3>Create a Cookie:</h3>";
    ?>

    <form method="post" action="">
        <label for="cookieName">Cookie Name:</label>
        <input type="text" name="cookieName" id="cookieName" required placeholder="e.g., username">
        <br><br>
        
        <label for="cookieValue">Cookie Value:</label>
        <input type="text" name="cookieValue" id="cookieValue" required placeholder="e.g., John">
        <br><br>
        
        <label for="cookieDays">Expires in (days):</label>
        <input type="number" name="cookieDays" id="cookieDays" value="7" min="1" max="365">
        <br><br>
        
        <input type="submit" name="setCookie" value="Set Cookie">
    </form>

    <?php

    echo "<h3>Your Current Cookies:</h3>";
    
    if (count($_COOKIE) > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr><th>Cookie Name</th><th>Value</th><th>Action</th></tr>";
        
        foreach ($_COOKIE as $name => $value) {
            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($name) . "</strong></td>";
            echo "<td>" . htmlspecialchars($value) . "</td>";
            echo "<td>
                    <form method='post' action='' style='margin: 0;'>
                        <input type='hidden' name='deleteCookieName' value='" . htmlspecialchars($name) . "'>
                        <input type='submit' name='deleteCookie' value='Delete' style='padding: 5px 10px;'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No cookies set yet.</p>";
    }

    echo "<h3>Practical Example: Remember Username</h3>";
    
    // Check if username cookie exists
    if (isset($_COOKIE['user_name'])) {
        echo "<p>Welcome back, <strong>" . htmlspecialchars($_COOKIE['user_name']) . "</strong>!</p>";
    } else {
        echo "<p>No username saved yet.</p>";
    }
    
    ?>

    <form method="post" action="">
        <input type="hidden" name="cookieName" value="user_name">
        <label for="userName">Your Name:</label>
        <input type="text" name="cookieValue" id="userName" required placeholder="Enter your name">
        <input type="hidden" name="cookieDays" value="30">
        <input type="submit" name="setCookie" value="Remember Me">
    </form>

    <?php
include 'template/footer.php'; ?>