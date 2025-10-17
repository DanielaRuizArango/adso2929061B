<?php
$tittle = "26 - Server Side Includes (SSI)";
$descripcion = "Using include and require to reuse code and create modular PHP applications";

include_once 'template/header.php';
?>

<section>
    <h3>Include vs Require:</h3>
    <ul>
        <li><strong>include:</strong> Produces a warning if file not found, script continues.</li>
        <li><strong>require:</strong> Produces a fatal error if file not found, script stops.</li>
        <li><strong>include_once:</strong> Like include, but prevents re-inclusion.</li>
        <li><strong>require_once:</strong> Like require, but prevents re-inclusion.</li>
    </ul>

    <h3>Example: Including Reusable Components</h3>
    <p>This page uses includes for header and footer:</p>
    <pre><code>include 'template/header.php';
include 'template/footer.php';</code></pre>

    <h3>Including a Config File:</h3>
    <p>Common use: Store database credentials or site settings</p>
    <pre><code>&lt;?php
// config.php
$dbHost = 'localhost';
$dbName = 'myDatabase';
$siteName = 'My Website';
?&gt;</code></pre>

    <pre><code>include 'config.php';</code></pre>

    <h3>Including Functions:</h3>
    <p>Example of including a functions file:</p>
    <pre><code>&lt;?php
// functions.php
function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}
?&gt;</code></pre>

    <?php
    // Definición real (protegida para evitar redeclaración)
    if (!function_exists('formatCurrency')) {
        function formatCurrency($amount) {
            return '$' . number_format($amount, 2);
        }
    }
    ?>
    <p>Using the function: <?= formatCurrency(1234.56) ?></p>
</section>

<?php include_once 'template/footer.php'; ?>
