<?php

    $tittle = "30 - Sessions";
    $descripcion = "Working with sessions in PHP to store user data on the server side";

    // Start session BEFORE any HTML output
    session_start();

    // Process session actions
    if (isset($_POST['setSession'])) {
        $_SESSION['username'] = htmlspecialchars($_POST['username']);
        $_SESSION['email'] = htmlspecialchars($_POST['email']);
        $_SESSION['login_time'] = date("Y-m-d H:i:s");
        $successMessage = "Session data saved successfully!";
    }

    if (isset($_POST['destroySession'])) {
        session_destroy();
        $deleteMessage = "Session destroyed! Refresh to see changes.";
    }

    if (isset($_POST['unsetVariable'])) {
        $varName = $_POST['varName'];
        unset($_SESSION[$varName]);
        $unsetMessage = "Variable '$varName' removed from session!";
    }

include 'template/header.php';
    echo '<section>';

    // Display messages
    if (isset($successMessage)) {
        echo "<p style='color: green;'>✓ $successMessage</p>";
    }
    
    if (isset($deleteMessage)) {
        echo "<p style='color: orange;'>✓ $deleteMessage</p>";
    }

    if (isset($unsetMessage)) {
        echo "<p style='color: blue;'>✓ $unsetMessage</p>";
    }


    echo "<h3>Store Data in Session:</h3>";
    ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required placeholder="Enter username" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="Enter email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
        <br><br>
        
        <input type="submit" name="setSession" value="Save to Session">
    </form>

    <?php

    echo "<h3>Current Session Data:</h3>";
    
    if (!empty($_SESSION)) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr><th>Variable</th><th>Value</th><th>Action</th></tr>";
        
        foreach ($_SESSION as $key => $value) {
            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($key) . "</strong></td>";
            echo "<td>" . htmlspecialchars($value) . "</td>";
            echo "<td>
                    <form method='post' action='' style='margin: 0;'>
                        <input type='hidden' name='varName' value='" . htmlspecialchars($key) . "'>
                        <input type='submit' name='unsetVariable' value='Remove' style='padding: 5px 10px;'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        
        echo "</table>";
        echo "<br>";
        
        echo "<form method='post' action=''>";
        echo "<input type='submit' name='destroySession' value='Destroy Entire Session' style='background: #d9534f; color: white; padding: 10px 20px; border: none; cursor: pointer;'>";
        echo "</form>";
    } else {
        echo "<p>No session data stored yet.</p>";
    }

    echo "<h3>Practical Example: Login Simulation</h3>";
    
    if (isset($_SESSION['username'])) {
        echo "<div style='border: 2px solid green; padding: 15px; background: #d4edda;'>";
        echo "<p>✓ <strong>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</strong></p>";
        echo "<p>Email: " . htmlspecialchars($_SESSION['email']) . "</p>";
        echo "<p>Logged in at: " . htmlspecialchars($_SESSION['login_time']) . "</p>";
        echo "</div>";
    } else {
        echo "<div style='border: 2px solid orange; padding: 15px; background: #fff3cd;'>";
        echo "<p>⚠ You are not logged in. Please save session data above.</p>";
        echo "</div>";
    }

include 'template/footer.php'; ?>