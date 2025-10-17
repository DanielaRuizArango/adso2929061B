<?php

    $tittle = "28 - Upload Files";
    $descripcion = "Uploading files to the server using PHP form handling with security validations";

include 'template/header.php';
    echo '<section>';
    
    // Add CSS styles
    echo '<style>
        .upload-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .upload-form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        
        .file-input {
            width: 100%;
            padding: 12px;
            border: 2px dashed #ddd;
            border-radius: 6px;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .file-input:hover {
            border-color: #007bff;
            background: #f0f8ff;
        }
        
        .file-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }
        
        .upload-btn {
            background:  #0056b3;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .upload-btn:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }
        
        .upload-btn:active {
            transform: translateY(0);
        }
        
        .file-info {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
            padding: 8px;
            background: #e9ecef;
            border-radius: 4px;
        }
        
        .message {
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            font-weight: 500;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .file-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #28a745;
        }
        
        .file-details p {
            margin: 8px 0;
            color: #333;
        }
        
        .uploaded-image {
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .files-list {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .files-list h3 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
        }
        
        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }
        
        .file-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .file-name {
            font-weight: 600;
            color: #333;
        }
        
        .file-meta {
            font-size: 12px;
            color: #666;
        }
        
        .no-files {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
        }
        
        @media (max-width: 768px) {
            .upload-container {
                margin: 10px;
                padding: 15px;
            }
            
            .upload-form, .files-list {
                padding: 20px;
            }
            
            .file-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .file-meta {
                margin-top: 5px;
            }
        }
    </style>';
    
    echo '<div class="upload-container">';

    $uploadDir = 'uploads/';
    
    // Create upload directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

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
                        echo "<div class='message success'>File uploaded successfully!</div>";
                        
                        // Display only image if it's an image file
                        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo "<div class='file-details'>";
                            echo "<img src='$destination' class='uploaded-image' alt='Uploaded image'>";
                            echo "</div>";
                        } else {
                            // Show details for non-image files
                            echo "<div class='file-details'>";
                            echo "<p><strong>Original name:</strong> $fileName</p>";
                            echo "<p><strong>Saved as:</strong> $newFileName</p>";
                            echo "<p><strong>Size:</strong> " . round($fileSize / 1024, 2) . " KB</p>";
                            echo "<p><strong>Type:</strong> $fileType</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='message error'>Error moving the file.</div>";
                    }
                } else {
                    echo "<div class='message error'>File is too large. Maximum 5MB allowed.</div>";
                }
            } else {
                echo "<div class='message error'>File type not allowed. Allowed: " . implode(', ', $allowedExt) . "</div>";
            }
        } else {
            echo "<div class='message error'>Error uploading file. Error code: " . $file['error'] . "</div>";
        }
    }

    ?>

    <div class="upload-form">
        <h3>Upload New File</h3>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="fileUpload" id="fileUpload" class="file-input" required>
                <div class="file-info">
                    <strong>Allowed:</strong> JPG, PNG, GIF, PDF, TXT, DOC, DOCX | <strong>Max size:</strong> 5MB
                </div>
            </div>
            <button type="submit" class="upload-btn">Upload File</button>
        </form>
    </div>

    <?php

    echo "</div>"; // Close upload-container

include 'template/footer.php'; ?>