<?php

    $tittle = "33 - Filters";
    $descripcion = "Validating and sanitizing user input using PHP filter functions";

include 'template/header.php';
    echo '<section>';
    
    // Add CSS styles
    echo '<style>
        .filters-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .filters-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            color: #333;
        }
        
        .filters-title {
            text-align: center;
            color: #333;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: none;
            border-bottom: 3px dotted #6f42c1;
            padding-bottom: 15px;
        }
        
        .section-title {
            color: #333;
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #6f42c1;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            margin-top: 20px;
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
            border-color: #6f42c1;
            box-shadow: 0 0 0 3px rgba(111,66,193,0.1);
        }
        
        .form-input::placeholder {
            color: #6c757d;
            font-style: italic;
        }
        
        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #dee2e6;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            box-sizing: border-box;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #6f42c1;
            box-shadow: 0 0 0 3px rgba(111,66,193,0.1);
        }
        
        .btn {
            background: #6f42c1;
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
            background: #5a2d91;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111,66,193,0.4);
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
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .result-box {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .result-item {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .result-item:last-child {
            border-bottom: none;
        }
        
        .result-item strong {
            color: #495057;
            display: inline-block;
            width: 140px;
        }
        
        .result-value {
            font-family: monospace;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            color: #6f42c1;
            word-break: break-all;
        }
        
        .url-link {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        
        .url-link:hover {
            background: #0056b3;
            text-decoration: none;
        }
        
        .form-inline {
            display: flex;
            align-items: end;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .form-inline .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        
        .form-inline .btn {
            flex-shrink: 0;
        }
        
        @media (max-width: 768px) {
            .filters-container {
                margin: 10px;
                padding: 15px;
            }
            
            .filters-card {
                padding: 20px;
            }
            
            .form-inline {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .form-inline .form-group {
                margin-bottom: 15px;
            }
            
            .btn {
                width: 100%;
            }
            
            .result-item strong {
                width: 100%;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>';
    
    echo '<div class="filters-container">';
    echo '<h1 class="filters-title">PHP Filters</h1>';
    
    echo '<div class="filters-card">';
    echo '<h3 class="section-title">Email Validation & Sanitization</h3>';
    
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        
        echo "<div class='result-box'>";
        echo "<div class='result-item'><strong>Original email:</strong> <span class='result-value'>" . htmlspecialchars($email) . "</span></div>";
        
        // Sanitize email
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        echo "<div class='result-item'><strong>Sanitized email:</strong> <span class='result-value'>$sanitizedEmail</span></div>";
        echo "</div>";
        
        // Validate email
        if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='message success'>✓ Valid email address!</div>";
        } else {
            echo "<div class='message error'>✗ Invalid email address!</div>";
        }
    }
    
    ?>

    <div class="form-container">
        <form method="post" action="">
            <div class="form-inline">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address:</label>
                    <input type="text" name="email" id="email" class="form-input" placeholder="test@example.com" required>
                </div>
                <button type="submit" class="btn">Validate Email</button>
            </div>
        </form>
    </div>
    </div> <!-- Close filters-card -->

    <?php

    echo '<div class="filters-card">';
    echo '<h3 class="section-title">Integer Validation</h3>';
    
    if (isset($_POST['number'])) {
        $number = $_POST['number'];
        
        echo "<div class='result-box'>";
        echo "<div class='result-item'><strong>Input:</strong> <span class='result-value'>" . htmlspecialchars($number) . "</span></div>";
        echo "</div>";
        
        // Validate integer
        if (filter_var($number, FILTER_VALIDATE_INT)) {
            echo "<div class='message success'>✓ Valid integer!</div>";
        } else {
            echo "<div class='message error'>✗ Not a valid integer!</div>";
        }
        
        // Validate integer with range
        $options = [
            'options' => [
                'min_range' => 1,
                'max_range' => 100
            ]
        ];
        
        if (filter_var($number, FILTER_VALIDATE_INT, $options)) {
            echo "<div class='message success'>✓ Number is between 1 and 100!</div>";
        } else {
            echo "<div class='message error'>✗ Number must be between 1 and 100!</div>";
        }
    }
    
    ?>

    <div class="form-container">
        <form method="post" action="">
            <div class="form-inline">
                <div class="form-group">
                    <label for="number" class="form-label">Enter a number (1-100):</label>
                    <input type="text" name="number" id="number" class="form-input" placeholder="42" required>
                </div>
                <button type="submit" class="btn">Validate Number</button>
            </div>
        </form>
    </div>
    </div> <!-- Close filters-card -->

    <?php

    echo '<div class="filters-card">';
    echo '<h3 class="section-title">URL Validation & Sanitization</h3>';
    
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        
        echo "<div class='result-box'>";
        echo "<div class='result-item'><strong>Original URL:</strong> <span class='result-value'>" . htmlspecialchars($url) . "</span></div>";
        
        // Sanitize URL
        $sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);
        echo "<div class='result-item'><strong>Sanitized URL:</strong> <span class='result-value'>$sanitizedUrl</span></div>";
        echo "</div>";
        
        // Validate URL
        if (filter_var($sanitizedUrl, FILTER_VALIDATE_URL)) {
            echo "<div class='message success'>✓ Valid URL!</div>";
            echo "<a href='$sanitizedUrl' target='_blank' class='url-link'>Visit URL</a>";
        } else {
            echo "<div class='message error'>✗ Invalid URL!</div>";
        }
    }
    
    ?>

    <div class="form-container">
        <form method="post" action="">
            <div class="form-inline">
                <div class="form-group">
                    <label for="url" class="form-label">Website URL:</label>
                    <input type="text" name="url" id="url" class="form-input" placeholder="https://example.com" required>
                </div>
                <button type="submit" class="btn">Validate URL</button>
            </div>
        </form>
    </div>
    </div> <!-- Close filters-card -->

    <?php

    echo '<div class="filters-card">';
    echo '<h3 class="section-title">String Sanitization (XSS Prevention)</h3>';
    
    if (isset($_POST['text'])) {
        $text = $_POST['text'];
        
        echo "<div class='result-box'>";
        echo "<div class='result-item'><strong>Original text:</strong> <span class='result-value'>" . htmlspecialchars($text) . "</span></div>";
        
        // Alternative: htmlspecialchars (recommended)
        $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        echo "<div class='result-item'><strong>Sanitized text:</strong> <span class='result-value'>$safeText</span></div>";
        
        // Strip tags completely
        $strippedText = strip_tags($text);
        echo "<div class='result-item'><strong>Stripped tags:</strong> <span class='result-value'>$strippedText</span></div>";
        echo "</div>";
        
        echo "<div class='message success'>✓ Text sanitized successfully!</div>";
    }
    
    ?>

    <div class="form-container">
        <form method="post" action="">
            <div class="form-group">
                <label for="text" class="form-label">Enter text (try with HTML tags):</label>
                <textarea name="text" id="text" class="form-textarea" placeholder="Try: <script>alert('XSS')</script>" required></textarea>
            </div>
            <button type="submit" class="btn">Sanitize Text</button>
        </form>
    </div>
    </div> <!-- Close filters-card -->
    
    </div> <!-- Close filters-container -->

    <?php
include 'template/footer.php'; ?>