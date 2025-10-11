<?php

    $tittle = "27 - File Text";
    $descripcion = "Reading and writing text files in PHP using file functions";

include 'template/header.php';
    echo '<section>';

    $filename = 'data/notes.txt';
    
    // Create directory if it doesn't exist
    if (!file_exists('data')) {
        mkdir('data', 0777, true);
    }

    echo "<h3>File Operations</h3>";

    // Write to file
    if (isset($_POST['write'])) {
        $content = htmlspecialchars($_POST['content']);
        file_put_contents($filename, $content);
        echo "<p style='color: green;'>✓ File written successfully!</p>";
    }

    // Append to file
    if (isset($_POST['append'])) {
        $content = htmlspecialchars($_POST['content']);
        file_put_contents($filename, $content . "\n", FILE_APPEND);
        echo "<p style='color: green;'>✓ Content appended successfully!</p>";
    }

    // Read file
    echo "<h3>Current File Content:</h3>";
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
        echo "<div style='border: 1px solid #ccc; padding: 10px; background: #f9f9f9;'>";
        echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
        echo "</div>";
        
        // File info
        echo "<p><strong>File size:</strong> " . filesize($filename) . " bytes</p>";
        echo "<p><strong>Last modified:</strong> " . date("Y-m-d H:i:s", filemtime($filename)) . "</p>";
        
        // Read line by line
        echo "<h3>File Content (Line by Line):</h3>";
        $lines = file($filename);
        echo "<ol>";
        foreach ($lines as $line) {
            echo "<li>" . htmlspecialchars($line) . "</li>";
        }
        echo "</ol>";
    } else {
        echo "<p>No file exists yet. Write some content first!</p>";
    }

    ?>

    <h3>Write to File (Overwrite):</h3>
    <form method="post" action="">
        <textarea name="content" rows="5" cols="50" required>Hello from PHP!
This is a new line.
Learning file operations is fun!</textarea>
        <br><br>
        <input type="submit" name="write" value="Write to File">
    </form>

    <h3>Append to File:</h3>
    <form method="post" action="">
        <input type="text" name="content" placeholder="Add a new line..." required style="width: 300px;">
        <input type="submit" name="append" value="Append to File">
    </form>

    <?php

include 'template/footer.php'; ?>