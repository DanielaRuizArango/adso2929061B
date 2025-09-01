<?php

    $tittle = "10 - Conditional IF";
    $descripcion = "Perform conditional operations on variables";

include 'template/header.php';
    echo '<section>';

    echo $days = date("D");
?>
 <?php  if ($days == 'Mon'): ?>
    <p>Today is Monday!</p>
<?php elseif ($days == 'Tue'): ?>
    <p>Today is Tuesday!</p>
<?php elseif ($days == 'Wed'): ?>
    <p>Today is Wednesday!</p>
    <?php elseif ($days == 'Thu'): ?>
    <p>Today is Thursday!</p>
    <?php elseif ($days == 'Fri'): ?>
    <p>Today is Friday!</p>
    <?php else: ?>
    <p>Happy weekend</p>
<?php endif; ?>

<?php
include 'template/footer.php'; ?>
