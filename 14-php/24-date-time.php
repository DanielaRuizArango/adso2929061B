<?php

    $tittle = "24 - Date & Time";
    $descripcion = "Working with dates and times in PHP using date() and time() functions";

include 'template/header.php';
    echo '<section>';

    // Current timestamp
    $currentTime = time();
    echo '<div class="timestamp-box">';
    echo "Current Timestamp: $currentTime";
    echo '</div>';

    // Different date formats
    echo '<div class="info-section">';
    echo "<h3>Date Formats:</h3>";
    echo "<p><strong>Full date:</strong> " . date("l, F j, Y") . "</p>";
    echo "<p><strong>Short date:</strong> " . date("m/d/Y") . "</p>";
    echo "<p><strong>Time (12h):</strong> " . date("g:i:s A") . "</p>";
    echo "<p><strong>Time (24h):</strong> " . date("H:i:s") . "</p>";
    echo "<p><strong>ISO 8601:</strong> " . date("c") . "</p>";
    echo '</div>';

    // Specific date
    $specificDate = mktime(15, 30, 0, 12, 25, 2024);
    echo '<div class="info-section">';
    echo "<h3>Specific Date (Christmas 2024 at 3:30 PM):</h3>";
    echo "<p>" . date("l, F j, Y g:i A", $specificDate) . "</p>";
    echo '</div>';

    // Date calculations
    echo '<div class="info-section">';
    echo "<h3>Date Calculations:</h3>";
    $tomorrow = strtotime("+1 day");
    $nextWeek = strtotime("+1 week");
    $lastMonth = strtotime("-1 month");
    
    echo "<p><strong>Tomorrow:</strong> " . date("Y-m-d", $tomorrow) . "</p>";
    echo "<p><strong>Next week:</strong> " . date("Y-m-d", $nextWeek) . "</p>";
    echo "<p><strong>Last month:</strong> " . date("Y-m-d", $lastMonth) . "</p>";
    echo '</div>';


    echo '<h3 class="section-title">Interactive Date Formatter:</h3>';
    ?>

<style>
    section {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 1000px;
    }
    
    .info-section {
        margin: 25px 0;
        padding: 0;
    }
    
    .info-section h3, .section-title {
        color: #495057;
        border-bottom: 2px solid #007bff;
        padding-bottom: 8px;
        margin-bottom: 15px;
        margin-top: 25px;
        font-size: 1.3em;
    }
    
    .info-section p {
        margin: 8px 0;
        padding: 8px 12px;
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        border-radius: 0 4px 4px 0;
    }
    
    .info-section p strong {
        color: #495057;
        display: inline-block;
        min-width: 120px;
    }
    
    .timestamp-box {
        background: #0056b3;
        color: white;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        margin: 15px 0;
        font-size: 1.2em;
        font-weight: bold;
    }
    
    .date-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        margin: 20px 0;
        max-width: 500px;
    }
    
    .date-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057;
    }
    
    .date-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 2px solid #ced4da;
        border-radius: 5px;
        font-size: 16px;
        background-color: white;
        transition: border-color 0.3s ease;
    }
    
    .date-form select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }
    
    .date-btn {
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .date-btn:hover {
        background: #218838;
    }
    
    .result-box {
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-left: 4px solid #007bff;
    }
    
    .result-box p {
        margin: 0;
        font-size: 1.1em;
        color: #495057;
    }
    
    .result-box strong {
        color: #007bff;
        font-weight: 600;
    }
</style>

<div class="date-form">
    <form method="get" action="">
        <label for="format">Choose format:</label>
        <select id="format" name="format">
            <option value="Y-m-d">YYYY-MM-DD</option>
            <option value="d/m/Y">DD/MM/YYYY</option>
            <option value="F j, Y">Month Day, Year</option>
            <option value="l, F j, Y g:i A">Full format</option>
        </select>
        <input type="submit" value="Show Date" class="date-btn">
    </form>
</div>

<?php

    if (isset($_GET['format'])) {
        $format = htmlspecialchars($_GET['format']);
        echo '<div class="result-box">';
        echo "<p><strong>Formatted date:</strong> " . date($format) . "</p>";
        echo '</div>';
    }

    echo '</section>';

include 'template/footer.php'; ?>