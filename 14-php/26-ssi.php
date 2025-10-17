<?php
$tittle = "26 - Server Side Includes (SSI)";
$descripcion = "Simple example of including files in PHP";

include_once 'template/header.php';
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
        margin-bottom: 20px;
        font-size: 1.3em;
    }
    
    .content-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #0056b3;
        margin: 20px 0;
    }
    
    .lorem-text {
        color: #6c757d;
        line-height: 1.6;
        margin: 15px 0;
    }
    
    .code-example {
        background: #f1f3f4;
        padding: 15px;
        border-radius: 5px;
        font-family: 'Courier New', monospace;
        border: 1px solid #dee2e6;
        margin: 15px 0;
    }
</style>

<section>
    <h3 class="page-title">What is Server Side Includes?</h3>
    
    <div class="content-box">
        <p><strong>Server Side Includes (SSI)</strong> allows you to include the content of one file into another file.</p>
        
        <p class="lorem-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        </p>
    </div>
</section>

<?php include_once 'template/footer.php'; ?>
