<?php

    $tittle = "27 - File Text";
    $descripcion = "Reading and writing text files in PHP using file functions";

include 'template/header.php';
?>

<style>
    section {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 900px;
    }
    
    .page-title {
        color: #495057;
        border-bottom: 2px solid #0056b3;
        padding-bottom: 8px;
        margin-bottom: 20px;
        font-size: 1.3em;
    }
    
    .success-message {
        background: #d4edda;
        border: 1px solid #28a745;
        border-left: 4px solid #28a745;
        padding: 15px;
        border-radius: 5px;
        margin: 15px 0;
        color: #155724;
    }
    
    .file-content {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        border-left: 4px solid #0056b3;
    }
    
    .file-content pre {
        margin: 0;
        font-family: 'Courier New', monospace;
        color: #495057;
        white-space: pre-wrap;
    }
    
    .file-info {
        background: #e7f3ff;
        padding: 15px;
        border-radius: 5px;
        margin: 15px 0;
        border-left: 4px solid #0056b3;
    }
    
    .file-info p {
        margin: 5px 0;
        color: #495057;
    }
    
    .lines-list {
        background: #f1f3f4;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .lines-list ol {
        margin: 0;
        padding-left: 25px;
    }
    
    .lines-list li {
        margin: 8px 0;
        color: #495057;
        font-family: 'Courier New', monospace;
    }
    
    .form-container {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin: 25px 0;
    }
    
    .form-container h3 {
        color: #495057;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.2em;
    }
    
    .form-container textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Courier New', monospace;
        resize: vertical;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }
    
    .form-container input[type="text"] {
        width: 70%;
        padding: 12px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
        margin-right: 10px;
    }
    
    .form-container textarea:focus,
    .form-container input[type="text"]:focus {
        outline: none;
        border-color: #0056b3;
        box-shadow: 0 0 0 3px rgba(0,86,179,0.25);
    }
    
    .btn {
        background: #0056b3;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }
    
    .btn:hover {
        background: #004085;
    }
    
    .btn-append {
        background: #28a745;
    }
    
    .btn-append:hover {
        background: #218838;
    }
    
    .no-file-message {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-left: 4px solid #f39c12;
        padding: 15px;
        border-radius: 5px;
        color: #856404;
        margin: 20px 0;
    }
</style>

<?php
    echo '<section>';

    $filename = 'data/notes.txt';
    
    // Create directory if it doesn't exist
    if (!file_exists('data')) {
        mkdir('data', 0777, true);
    }

    echo '<h3 class="page-title">File Operations</h3>';

    // Write to file
    if (isset($_POST['write'])) {
        $content = htmlspecialchars($_POST['content']);
        file_put_contents($filename, $content);
        echo '<div class="success-message">✓ File written successfully!</div>';
    }

    // Append to file
    if (isset($_POST['append'])) {
        $content = htmlspecialchars($_POST['content']);
        file_put_contents($filename, $content . "\n", FILE_APPEND);
        echo '<div class="success-message">✓ Content appended successfully!</div>';
    }

    // Read file
    echo '<h3 class="page-title">Current File Content:</h3>';
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
        echo '<div class="file-content">';
        echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
        echo '</div>';
        
        // File info
        echo '<div class="file-info">';
        echo "<p><strong>File size:</strong> " . filesize($filename) . " bytes</p>";
        echo "<p><strong>Last modified:</strong> " . date("Y-m-d H:i:s", filemtime($filename)) . "</p>";
        echo '</div>';
        
        // Read line by line
        echo '<h3 class="page-title">File Content (Line by Line):</h3>';
        $lines = file($filename);
        echo '<div class="lines-list">';
        echo "<ol>";
        foreach ($lines as $line) {
            echo "<li>" . htmlspecialchars($line) . "</li>";
        }
        echo "</ol>";
        echo '</div>';
    } else {
        echo '<div class="no-file-message">No file exists yet. Write some content first!</div>';
    }

    ?>

<div class="form-container">
    <h3>Write to File (Overwrite):</h3>
    <form method="post" action="">
        <textarea name="content" rows="6" required>Hello from PHP!
This is a new line.
Learning file operations is fun!</textarea>
        <br><br>
        <input type="submit" name="write" value="Write to File" class="btn">
    </form>
</div>

<div class="form-container">
    <h3>Append to File:</h3>
    <form method="post" action="">
        <input type="text" name="content" placeholder="Add a new line..." required>
        <input type="submit" name="append" value="Append to File" class="btn btn-append">
    </form>
</div>

    <?php

include 'template/footer.php'; ?>