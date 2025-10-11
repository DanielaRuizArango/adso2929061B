<?php

    $tittle = "24 - Date & Time";
    $descripcion = "Working with dates and times in PHP using date() and time() functions";

include 'template/header.php';
    echo '<section>';

    // Current timestamp
    $currentTime = time();
    echo "<h3>Current Timestamp: $currentTime</h3>";

    // Different date formats
    echo "<h3>Date Formats:</h3>";
    echo "<p><strong>Full date:</strong> " . date("l, F j, Y") . "</p>";
    echo "<p><strong>Short date:</strong> " . date("m/d/Y") . "</p>";
    echo "<p><strong>Time (12h):</strong> " . date("g:i:s A") . "</p>";
    echo "<p><strong>Time (24h):</strong> " . date("H:i:s") . "</p>";
    echo "<p><strong>ISO 8601:</strong> " . date("c") . "</p>";

    // Specific date
    $specificDate = mktime(15, 30, 0, 12, 25, 2024);
    echo "<h3>Specific Date (Christmas 2024 at 3:30 PM):</h3>";
    echo "<p>" . date("l, F j, Y g:i A", $specificDate) . "</p>";

    // Date calculations
    echo "<h3>Date Calculations:</h3>";
    $tomorrow = strtotime("+1 day");
    $nextWeek = strtotime("+1 week");
    $lastMonth = strtotime("-1 month");
    
    echo "<p><strong>Tomorrow:</strong> " . date("Y-m-d", $tomorrow) . "</p>";
    echo "<p><strong>Next week:</strong> " . date("Y-m-d", $nextWeek) . "</p>";
    echo "<p><strong>Last month:</strong> " . date("Y-m-d", $lastMonth) . "</p>";


    echo "<h3>Interactive Date Formatter:</h3>";
    echo '<form method="get" action="">';
    echo '<label for="format">Choose format:</label>';
    echo '<select id="format" name="format">';
    echo '<option value="Y-m-d">YYYY-MM-DD</option>';
    echo '<option value="d/m/Y">DD/MM/YYYY</option>';
    echo '<option value="F j, Y">Month Day, Year</option>';
    echo '<option value="l, F j, Y g:i A">Full format</option>';
    echo '</select>';
    echo '<input type="submit" value="Show Date">';
    echo '</form>';

    if (isset($_GET['format'])) {
        $format = htmlspecialchars($_GET['format']);
        echo "<p><strong>Formatted date:</strong> " . date($format) . "</p>";
    }

    echo '</section>';

include 'template/footer.php'; ?>