<?php

    $tittle = "28 - Upload Files";
    $descripcion = "Uploading files to the server using PHP form handling with security validations";

include 'template/header.php';
    echo '<section>';

    $uploadDir = 'uploads/';
    
    // Create upload directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    echo "<h3>File Upload Form</h3>";

    // Process file upload
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['fileUpload'])) {
        $file = $_FILES['fileUpload'];
        
        // Check if file was uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($file['name']);
            $fileSize = $file['size'];
            $fileTmpName = $file['tmp_name'];
            $fileType = $file['type'];
            
            // Get file extension
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            // Allowed extensions
            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx'];
            
            // Validate extension
            if (in_array($fileExt, $allowedExt)) {
                // Validate size (5MB max)
                if ($fileSize < 5000000) {
                    // Generate unique filename
                    $newFileName = uniqid('file_', true) . '.' . $fileExt;
                    $destination = $uploadDir . $newFileName;
                    
                    // Move uploaded file
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        echo "<p style='color: green;'>✓ File uploaded successfully!</p>";
                        echo "<p><strong>Original name:</strong> $fileName</p>";
                        echo "<p><strong>Saved as:</strong> $newFileName</p>";
                        echo "<p><strong>Size:</strong> " . round($fileSize / 1024, 2) . " KB</p>";
                        echo "<p><strong>Type:</strong> $fileType</p>";
                        
                        // Display image if it's an image file
                        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo "<p><img src='$destination' style='max-width: 300px; border: 1px solid #ccc;' alt='Uploaded image'></p>";
                        }
                    } else {
                        echo "<p style='color: red;'>✗ Error moving the file.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>✗ File is too large. Maximum 5MB allowed.</p>";
                }
            } else {
                echo "<p style='color: red;'>✗ File type not allowed. Allowed: " . implode(', ', $allowedExt) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>✗ Error uploading file. Error code: " . $file['error'] . "</p>";
        }
    }

    ?>

    <form method="post" action="" enctype="multipart/form-data">
        <label for="fileUpload">Select file to upload:</label><br>
        <input type="file" name="fileUpload" id="fileUpload" required>
        <br><br>
        <input type="submit" value="Upload File">
    </form>

    <p><small>Allowed: JPG, PNG, GIF, PDF, TXT, DOC, DOCX | Max size: 5MB</small></p>

    <?php

    echo "<h3>Uploaded Files:</h3>";
    
    // List uploaded files
    if (file_exists($uploadDir)) {
        $files = scandir($uploadDir);
        $files = array_diff($files, ['.', '..']);
        
        if (count($files) > 0) {
            echo "<ul>";
            foreach ($files as $file) {
                $filePath = $uploadDir . $file;
                $fileSize = filesize($filePath);
                $fileDate = date("Y-m-d H:i:s", filemtime($filePath));
                
                echo "<li>";
                echo "<strong>$file</strong> - " . round($fileSize / 1024, 2) . " KB - $fileDate";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No files uploaded yet.</p>";
        }
    }

include 'template/footer.php'; ?>