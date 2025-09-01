<?php

    $tittle = "09 - Oper Logic";
    $descripcion = "Perform logic operations on variables";

include 'template/header.php';
    echo '<section>';

?>
<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Description</th>
            <th>Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&&</td>
            <td>Logical AND</td>
        <td><?php 
        $x=6; $y=3;
        echo '$x=6 | $y=3 | ($x<10&&$y>1)|'; 
        var_dump($x<10 && $y>1)?></td>
        </tr>
        <tr>
            <td>||</td>
            <td>OR</td>
        <td>
        <?php 
        $x=6; $y=3;
        echo '$x=6 | $y=3 | ($x==5 && $y==5)|'; 
        var_dump($x==5 || $y==5)?></td>
        </tr>
        <tr>
            <td>!</td>
            <td>NOT</td>
            <td><?php 
            $x=6; $y=3;
            echo '$x=6 | $y=3 | (!$x==5 && !$y==5)|'; 
            var_dump(!($x==$y))?></td>
        </tr>
    </tbody>
</table>
<?php
include 'template/footer.php'; ?>
