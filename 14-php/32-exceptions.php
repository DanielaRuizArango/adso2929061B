<?php
$tittle = "32 - Exceptions";
$descripcion = "Handling errors and exceptions in PHP using try-catch blocks and custom exceptions";

include 'template/header.php';
?>

<section>
    <!-- Add CSS styles -->
    <style>
        .exceptions-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .exceptions-card {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            color: #333;
        }
        
        .exceptions-title {
            text-align: center;
            color: #333;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: none;
            border-bottom: 3px dotted #dc3545;
            padding-bottom: 15px;
        }
        
        .section-title {
            color: #333;
            font-size: 1.4em;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #dc3545;
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
            max-width: 200px;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220,53,69,0.1);
        }
        
        .btn {
            background: #dc3545;
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
            margin-left: 10px;
        }
        
        .btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220,53,69,0.4);
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
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 20px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            overflow-x: auto;
        }
        
        .code-title {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 6px 6px 0 0;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 -1px 0;
        }
        
        .example-section {
            margin-bottom: 40px;
        }
        
        .form-inline {
            display: flex;
            align-items: end;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .form-inline .form-group {
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .exceptions-container {
                margin: 10px;
                padding: 15px;
            }
            
            .exceptions-card {
                padding: 20px;
            }
            
            .form-inline {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .form-input {
                max-width: 100%;
            }
            
            .btn {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    
    <div class="exceptions-container">
        
        <div class="exceptions-card">
            <h3 class="section-title">Custom Exception Class</h3>

    <?php
    // Custom exception
    class AgeException extends Exception {
        public function errorMessage() {
            return $this->getMessage();
        }
    }

    if (isset($_POST['age'])) {
        try {
            $age = (int)$_POST['age'];

            if ($age < 18) {
                throw new AgeException("You must be 18 or older!");
            } elseif ($age > 120) {
                throw new AgeException("Age seems unrealistic!");
            }

            echo "<div class='message success'>✓ Age $age is valid!</div>";

        } catch (AgeException $e) {
            echo "<div class='message error'>✗ " . $e->errorMessage() . "</div>";
        }
    }
    ?>

            <div class="form-container">
    <form method="post" action="">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="age" class="form-label">Enter your age:</label>
                            <input type="number" name="age" id="age" class="form-input" required min="1" max="150" placeholder="18">
                        </div>
                        <button type="submit" class="btn">Validate Age</button>
                    </div>
    </form>
            </div>
        </div> <!-- Close exceptions-card -->
    </div> <!-- Close exceptions-container -->
</section>

<?php include 'template/footer.php'; ?>
