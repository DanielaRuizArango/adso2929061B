<?php

    $tittle = "31 - Send Mail";
    $descripcion = "Sending emails using PHP mail() function with proper headers and validation";

include 'template/header.php';
    echo '<section>';

    echo "<h3>Send Email Form</h3>";

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
                echo "<p style='color: green;'>✓ Email sent successfully!</p>";
            } else {
                echo "<p style='color: orange;'>⚠ Email simulation mode (mail server not configured)</p>";
                echo "<p>Email would be sent with the following details:</p>";
                echo "<div style='border: 1px solid #ccc; padding: 15px; background: #f9f9f9;'>";
                echo "<p><strong>To:</strong> $to</p>";
                echo "<p><strong>From:</strong> $from</p>";
                echo "<p><strong>Subject:</strong> $subject</p>";
                echo "<p><strong>Message:</strong></p>";
                echo "<p>" . nl2br($message) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p style='color: red;'>✗ Invalid email address!</p>";
        }
    }

    ?>

    <form method="post" action="">
        <label for="from">Your Email:</label><br>
        <input type="email" name="from" id="from" required placeholder="your@email.com" style="width: 100%; max-width: 400px; padding: 8px;">
        <br><br>
        
        <label for="to">Recipient Email:</label><br>
        <input type="email" name="to" id="to" required placeholder="recipient@email.com" style="width: 100%; max-width: 400px; padding: 8px;">
        <br><br>
        
        <label for="subject">Subject:</label><br>
        <input type="text" name="subject" id="subject" required placeholder="Email subject" style="width: 100%; max-width: 400px; padding: 8px;">
        <br><br>
        
        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="6" required placeholder="Your message here..." style="width: 100%; max-width: 400px; padding: 8px;"></textarea>
        <br><br>
        
        <input type="submit" name="sendEmail" value="Send Email" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
    </form>

    <?php

include 'template/footer.php'; ?>