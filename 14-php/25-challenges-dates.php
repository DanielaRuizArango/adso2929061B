<?php

    $tittle = "25 - Challenges Dates";
    $descripcion = "Practice exercises with date calculations and manipulations";

include 'template/header.php';
    echo '<section>';

    echo '<h3 class="page-title">Age Calculator</h3>';
    echo '<p class="description">Enter your birthdate to calculate your age</p>';
    
    if (isset($_GET['birthdate']) && !empty($_GET['birthdate'])) {
        $birthdateInput = $_GET['birthdate'];
        
        // Validate date format
        if (DateTime::createFromFormat('Y-m-d', $birthdateInput)) {
            // Create birthdate
            $birthDateTime = new DateTime($birthdateInput);
            $todayDateTime = new DateTime();
            $age = $birthDateTime->diff($todayDateTime);
            
            // Convert to timestamp for some calculations
            $birthdate = $birthDateTime->getTimestamp();
            $today = time();
            
            echo '<div class="result-success">';
            echo "<h4>✓ Results:</h4>";
            
            echo "<p><strong>Your birthdate:</strong> " . $birthDateTime->format("l, F j, Y") . "</p>";
            echo "<p><strong>Your exact age:</strong> {$age->y} years, {$age->m} months, and {$age->d} days</p>";
            
            echo "<p><strong>You have lived:</strong></p>";
            echo "<p>• " . number_format($age->days) . " days</p>";
            echo "<p>• " . number_format($age->days * 24) . " hours</p>";
            echo "<p>• " . number_format($age->days * 24 * 60) . " minutes</p>";
            echo "<p>• " . number_format($age->days * 24 * 60 * 60) . " seconds</p>";
            
            // Next birthday
            $nextBirthday = new DateTime($birthDateTime->format('Y') . '-' . $birthDateTime->format('m') . '-' . $birthDateTime->format('d'));
            $nextBirthday->setDate(date('Y'), $birthDateTime->format('m'), $birthDateTime->format('d'));
            
            if ($nextBirthday < $todayDateTime) {
                $nextBirthday->setDate(date('Y') + 1, $birthDateTime->format('m'), $birthDateTime->format('d'));
            }
            
            $daysUntilBirthday = $todayDateTime->diff($nextBirthday)->days;
            
            echo "<p><strong>Days until next birthday:</strong> $daysUntilBirthday days</p>";
            echo "<p><strong>Day of week you were born:</strong> " . $birthDateTime->format("l") . "</p>";
            
            echo "</div>";
            
        } else {
            echo '<div class="error-message">';
            echo "✗ Invalid date format! Please select a valid date.";
            echo '</div>';
        }
    }
    
    ?>

<style>
    section {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 800px;
    }
    
    .page-title {
        color: #495057;
        border-bottom: 2px solid #0056b3;
        padding-bottom: 8px;
        margin-bottom: 15px;
        font-size: 1.4em;
    }
    
    .description {
        color: #6c757d;
        margin-bottom: 30px;
        font-size: 1.1em;
    }
    
    .form-container {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin: 20px 0;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057;
    }
    
    .date-input {
        width: 100%;
        max-width: 300px;
        padding: 12px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
        background-color: white;
    }
    
    .date-input:focus {
        outline: none;
        border-color: #0056b3;
        box-shadow: 0 0 0 3px rgba(0,86,179,0.25);
    }
    
    .calculate-btn {
        background: #0056b3;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .calculate-btn:hover {
        background: #004085;
    }
    
    .result-success {
        background: #e7f3ff;
        border: 1px solid #0056b3;
        border-left: 4px solid #0056b3;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .result-success h4 {
        color: #0056b3;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.2em;
        font-weight: 600;
    }
    
    .result-success p {
        margin: 10px 0;
        color: #495057;
        font-size: 1em;
        line-height: 1.5;
    }
    
    .result-success p strong {
        color: #0056b3;
        font-weight: 600;
    }
    
    .error-message {
        background: #f8d7da;
        border: 2px solid #dc3545;
        border-left: 6px solid #dc3545;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
        color: #721c24;
        font-weight: 600;
    }
</style>

<div class="form-container">
    <form method="get" action="">
        <div class="form-group">
            <label for="birthdate">Select your birthdate:</label>
            <input type="date" 
                   name="birthdate" 
                   id="birthdate" 
                   class="date-input"
                   value="<?php echo isset($_GET['birthdate']) ? $_GET['birthdate'] : ''; ?>"
                   max="<?php echo date('Y-m-d'); ?>"
                   required>
        </div>
        
        <button type="submit" class="calculate-btn">Calculate Age</button>
    </form>
</div>

    <?php

include 'template/footer.php'; ?>