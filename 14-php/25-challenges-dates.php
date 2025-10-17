<?php

    $tittle = "25 - Challenges Dates";
    $descripcion = "Practice exercises with date calculations and manipulations";

include 'template/header.php';
    echo '<section>';

    echo "<h3>Age Calculator</h3>";
    echo "<p>Enter your birthdate to calculate your age</p>";
    
    if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
        $day = (int)$_GET['day'];
        $month = (int)$_GET['month'];
        $year = (int)$_GET['year'];
        
        // Validate date
        if (checkdate($month, $day, $year)) {
            // Create birthdate
            $birthdate = mktime(0, 0, 0, $month, $day, $year);
            $today = time();
            
            // Calculate age
            $ageInSeconds = $today - $birthdate;
            $ageInYears = floor($ageInSeconds / (365 * 24 * 60 * 60));
            
            // More accurate age calculation
            $birthDateTime = new DateTime("$year-$month-$day");
            $todayDateTime = new DateTime();
            $age = $birthDateTime->diff($todayDateTime);
            
            echo "<div style='border: 2px solid green; padding: 20px; background: #d4edda; margin: 20px 0;'>";
            echo "<h4>✓ Results:</h4>";
            echo "<p><strong>Your birthdate:</strong> " . date("l, F j, Y", $birthdate) . "</p>";
            echo "<p><strong>Your exact age:</strong> {$age->y} years, {$age->m} months, and {$age->d} days</p>";
            echo "<p><strong>You have lived:</strong></p>";
            echo "<ul>";
            echo "<li>{$age->days} days</li>";
            echo "<li>" . ($age->days * 24) . " hours</li>";
            echo "<li>" . ($age->days * 24 * 60) . " minutes</li>";
            echo "<li>" . number_format($age->days * 24 * 60 * 60) . " seconds</li>";
            echo "</ul>";
            
            // Next birthday
            $nextBirthday = mktime(0, 0, 0, $month, $day, date("Y"));
            if ($nextBirthday < $today) {
                $nextBirthday = mktime(0, 0, 0, $month, $day, date("Y") + 1);
            }
            $daysUntilBirthday = floor(($nextBirthday - $today) / (24 * 60 * 60));
            
            echo "<p><strong>Days until next birthday:</strong> $daysUntilBirthday days</p>";
            echo "<p><strong>Day of week you were born:</strong> " . date("l", $birthdate) . "</p>";
            echo "</div>";
            
        } else {
            echo "<p style='color: red;'>✗ Invalid date! Please check day, month, and year.</p>";
        }
    }
    
    ?>

    <form method="get" action="">
        <div style="display: flex; gap: 10px; align-items: end; flex-wrap: wrap;">
            <div>
                <label for="day">Day:</label><br>
                <select name="day" id="day" required style="padding: 8px; font-size: 16px;">
                    <option value="">Select</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        $selected = (isset($_GET['day']) && $_GET['day'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <label for="month">Month:</label><br>
                <select name="month" id="month" required style="padding: 8px; font-size: 16px;">
                    <option value="">Select</option>
                    <?php
                    $months = [
                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                    ];
                    foreach ($months as $num => $name) {
                        $selected = (isset($_GET['month']) && $_GET['month'] == $num) ? 'selected' : '';
                        echo "<option value='$num' $selected>$name</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <label for="year">Year:</label><br>
                <select name="year" id="year" required style="padding: 8px; font-size: 16px;">
                    <option value="">Select</option>
                    <?php
                    $currentYear = date("Y");
                    for ($i = $currentYear; $i >= 1900; $i--) {
                        $selected = (isset($_GET['year']) && $_GET['year'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <input type="submit" value="Calculate Age" style="padding: 10px 20px; font-size: 16px; background: #007bff; color: white; border: none; cursor: pointer;">
            </div>
        </div>
    </form>

    <?php

include 'template/footer.php'; ?>