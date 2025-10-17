<?php

    $tittle = "31 - Send Mail";
    $descripcion = "Sending emails using PHP mail() function with proper headers and validation";

include 'template/header.php';
    echo '<section>';
    
    // Add CSS styles
    echo '<style>
        .mail-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .mail-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            color: #333;
        }
        
        .mail-title {
            text-align: center;
            color: #333;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: none;
            border-bottom: 3px dotted #007bff;
            padding-bottom: 15px;
        }
        
        .section-title {
            color: #333;
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #007bff;
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
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
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
            min-height: 120px;
            font-family: inherit;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }
        
        .btn {
            background: #007bff;
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
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.4);
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
        
        .message.warning {
            background: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .email-preview {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .email-preview h4 {
            color: #333;
            margin-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
        }
        
        .email-detail {
            margin: 10px 0;
            padding: 8px 0;
        }
        
        .email-detail strong {
            color: #495057;
            display: inline-block;
            width: 80px;
        }
        
        .email-message {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #007bff;
            margin-top: 10px;
            line-height: 1.6;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        @media (max-width: 768px) {
            .mail-container {
                margin: 10px;
                padding: 15px;
            }
            
            .mail-card {
                padding: 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>';
    
    echo '<div class="mail-container">';
    echo '<h1 class="mail-title">Send Email</h1>';
    echo '<div class="mail-card">';
    echo '<h3 class="section-title">Email Form</h3>';

    // Process email sending
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendEmail'])) {
        $to = htmlspecialchars($_POST['to']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);
        $from = htmlspecialchars($_POST['from']);
        
        // Validate email addresses
        if (filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL)) {
            
            // Email headers
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: " . $from . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            // HTML message
            $htmlMessage = "
            <html>
            <head>
                <title>$subject</title>
            </head>
            <body>
                <h2>Message from Contact Form</h2>
                <p><strong>From:</strong> $from</p>
                <hr>
                <p>$message</p>
                <hr>
                <p><small>This email was sent from your PHP contact form.</small></p>
            </body>
            </html>
            ";
            
            // Send email (Note: mail() requires a configured mail server)
            // For testing purposes, we'll simulate the sending
            $mailSent = false; // Change to: mail($to, $subject, $htmlMessage, $headers);
            
            if ($mailSent) {
                echo "<div class='message success'>✓ Email sent successfully!</div>";
            } else {
                echo "<div class='message warning'>⚠ Email simulation mode (mail server not configured)</div>";
                echo "<div class='email-preview'>";
                echo "<h4>Email Preview</h4>";
                echo "<div class='email-detail'><strong>To:</strong> $to</div>";
                echo "<div class='email-detail'><strong>From:</strong> $from</div>";
                echo "<div class='email-detail'><strong>Subject:</strong> $subject</div>";
                echo "<div class='email-detail'><strong>Message:</strong></div>";
                echo "<div class='email-message'>" . nl2br($message) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='message error'>✗ Invalid email address!</div>";
        }
    }

    
    echo "<div class='form-container'>";
    ?>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group">
                    <label for="from" class="form-label">Your Email:</label>
                    <input type="email" name="from" id="from" class="form-input" required placeholder="your@email.com">
                </div>
                
                <div class="form-group">
                    <label for="to" class="form-label">Recipient Email:</label>
                    <input type="email" name="to" id="to" class="form-input" required placeholder="recipient@email.com">
                </div>
            </div>
            
            <div class="form-group">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" name="subject" id="subject" class="form-input" required placeholder="Email subject">
            </div>
            
            <div class="form-group">
                <label for="message" class="form-label">Message:</label>
                <textarea name="message" id="message" class="form-textarea" required placeholder="Your message here..."></textarea>
            </div>
            
            <button type="submit" name="sendEmail" class="btn">Send Email</button>
        </form>
    
    <?php 
    echo "</div>"; // Close form-container
    echo "</div>"; // Close mail-card
    
    echo "</div>"; // Close mail-container

include 'template/footer.php'; ?>