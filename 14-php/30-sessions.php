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
    
    // Add CSS styles
    echo '<style>
        .sessions-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .sessions-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            color: #333;
        }
        
        .sessions-title {
            text-align: center;
            color: #333;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: none;
            border-bottom: 3px dotted #28a745;
            padding-bottom: 15px;
        }
        
        .section-title {
            color: #333;
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #dee2e6;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40,167,69,0.1);
        }
        
        .form-input::placeholder {
            color: #6c757d;
            font-style: italic;
        }
        
        .btn {
            background: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40,167,69,0.4);
        }
        
        .btn-remove {
            background: #dc3545;
            padding: 8px 15px;
            font-size: 12px;
        }
        
        .btn-remove:hover {
            background: #c82333;
        }
        
        .btn-destroy {
            background: #dc3545;
            padding: 12px 25px;
            font-size: 16px;
            margin-top: 15px;
        }
        
        .btn-destroy:hover {
            background: #c82333;
        }
        
        .sessions-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .sessions-table th {
            background: #28a745;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .sessions-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .sessions-table tr:hover {
            background: #f8f9fa;
        }
        
        .session-var {
            font-weight: 600;
            color: #495057;
        }
        
        .session-value {
            font-family: monospace;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            color: #6f42c1;
            word-break: break-all;
        }
        
        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .message.delete {
            background: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }
        
        .message.info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        
        .no-session {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        
        .login-status {
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border: 2px solid;
        }
        
        .login-status.logged-in {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        
        .login-status.not-logged {
            background: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }
        
        .session-info {
            margin: 8px 0;
        }
        
        .session-info strong {
            color: #333;
        }
        
        @media (max-width: 768px) {
            .sessions-container {
                margin: 10px;
                padding: 15px;
            }
            
            .sessions-card {
                padding: 20px;
            }
            
            .sessions-table {
                font-size: 14px;
            }
            
            .sessions-table th,
            .sessions-table td {
                padding: 10px 8px;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>';
    
    echo '<div class="sessions-container">';

    // Display messages
    if (isset($successMessage)) {
        echo "<div class='message success'>✓ $successMessage</div>";
    }
    
    if (isset($deleteMessage)) {
        echo "<div class='message delete'>✓ $deleteMessage</div>";
    }

    if (isset($unsetMessage)) {
        echo "<div class='message info'>✓ $unsetMessage</div>";
    }


    echo "<div class='sessions-card'>";
    echo "<h3 class='section-title'>Store Data in Session</h3>";
    echo "<div class='form-container'>";
    ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-input" required placeholder="Enter username" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-input" required placeholder="Enter email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
            </div>
            
            <button type="submit" name="setSession" class="btn">Save to Session</button>
        </form>
    
    <?php 
    echo "</div>"; // Close form-container
    echo "</div>"; // Close sessions-card

    echo "<div class='sessions-card'>";
    echo "<h3 class='section-title'>Current Session Data</h3>";
    
    if (!empty($_SESSION)) {
        echo "<table class='sessions-table'>";
        echo "<tr><th>Variable</th><th>Value</th><th>Action</th></tr>";
        
        foreach ($_SESSION as $key => $value) {
            echo "<tr>";
            echo "<td><span class='session-var'>" . htmlspecialchars($key) . "</span></td>";
            echo "<td><span class='session-value'>" . htmlspecialchars($value) . "</span></td>";
            echo "<td>
                    <form method='post' action='' style='margin: 0;'>
                        <input type='hidden' name='varName' value='" . htmlspecialchars($key) . "'>
                        <button type='submit' name='unsetVariable' class='btn btn-remove'>Remove</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        echo "<form method='post' action=''>";
        echo "<button type='submit' name='destroySession' class='btn btn-destroy'>Destroy Entire Session</button>";
        echo "</form>";
    } else {
        echo "<div class='no-session'>No session data stored yet.</div>";
    }
    echo "</div>"; // Close sessions-card

    echo "<div class='sessions-card'>";
    echo "<h3 class='section-title'>Practical Example: Login Simulation</h3>";
    
    if (isset($_SESSION['username'])) {
        echo "<div class='login-status logged-in'>";
        echo "<p class='session-info'>✓ <strong>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</strong></p>";
        echo "<p class='session-info'>Email: " . htmlspecialchars($_SESSION['email']) . "</p>";
        echo "<p class='session-info'>Logged in at: " . htmlspecialchars($_SESSION['login_time']) . "</p>";
        echo "</div>";
    } else {
        echo "<div class='login-status not-logged'>";
        echo "<p class='session-info'>⚠ You are not logged in. Please save session data above.</p>";
        echo "</div>";
    }
    echo "</div>"; // Close sessions-card
    
    echo "</div>"; // Close sessions-container

include 'template/footer.php'; ?>