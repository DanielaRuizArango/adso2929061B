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

    // Add CSS styles
    echo '<style>
        .cookies-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .cookies-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            color: #333;
        }
        
        .cookies-title {
            text-align: center;
            color: #333;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: none;
            border-bottom: 3px dotted #667eea;
            padding-bottom: 15px;
        }
        
        .section-title {
            color: #333;
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
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
        }
        
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
        }
        
        .form-input::placeholder {
            color: #6c757d;
            font-style: italic;
        }
        
        .btn {
            background: #667eea;
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
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        
        .btn-delete {
            background: #ff6b6b;
            padding: 8px 15px;
            font-size: 12px;
        }
        
        .btn-remember {
            background: #51cf66;
        }
        
        .cookies-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cookies-table th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .cookies-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .cookies-table tr:hover {
            background: #f8f9fa;
        }
        
        .cookie-name {
            font-weight: 600;
            color: #495057;
        }
        
        .cookie-value {
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
        
        .message small {
            display: block;
            margin-top: 5px;
            opacity: 0.8;
            font-size: 12px;
        }
        
        .no-cookies {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        
        .welcome-message {
            background: #e3f2fd;
            color: #0d47a1;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2196f3;
            margin: 15px 0;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            align-items: end;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .form-row .btn {
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .cookies-container {
                margin: 10px;
                padding: 15px;
            }
            
            .cookies-card {
                padding: 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .cookies-table {
                font-size: 14px;
            }
            
            .cookies-table th,
            .cookies-table td {
                padding: 10px 8px;
            }
        }
    </style>';
    
    echo '<div class="cookies-container">';
    echo '<h1 class="cookies-title">Create a Cookie</h1>';

    // Display messages
    if (isset($successMessage)) {
        echo "<div class='message success'>";
        echo "✓ $successMessage";
        echo "<small>Note: Refresh the page to see the cookie in the list below.</small>";
        echo "</div>";
    }
    
    if (isset($deleteMessage)) {
        echo "<div class='message delete'>";
        echo "✓ $deleteMessage";
        echo "<small>Note: Refresh the page to see changes.</small>";
        echo "</div>";
    }

    echo "<div class='cookies-card'>";
    echo "<h3 class='section-title'>Create New Cookie</h3>";
    echo "<div class='form-container'>";
    ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="cookieName" class="form-label">Cookie Name:</label>
                <input type="text" name="cookieName" id="cookieName" class="form-input" required placeholder="e.g., username">
            </div>
            
            <div class="form-group">
                <label for="cookieValue" class="form-label">Cookie Value:</label>
                <input type="text" name="cookieValue" id="cookieValue" class="form-input" required placeholder="e.g., John">
            </div>
            
            <div class="form-group">
                <label for="cookieDays" class="form-label">Expires in (days):</label>
                <input type="number" name="cookieDays" id="cookieDays" class="form-input" value="7" min="1" max="365">
            </div>
            
            <button type="submit" name="setCookie" class="btn">Set Cookie</button>
    </form>

    <?php
    echo "</div>"; // Close form-container
    echo "</div>"; // Close cookies-card


    
    echo "</div>"; // Close cookies-container

include 'template/footer.php'; ?>