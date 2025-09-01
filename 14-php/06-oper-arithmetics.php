<?php

    $tittle = "06 - Oper Arithmetics";
    $descripcion = "Perform mathematical calculations using numeric values";

include 'template/header.php';
    echo '<section>';

?>
<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Description</th>
            <th>Example</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>+</td>
            <td>Addition</td>
            <td>$x=2 | x+2</td>
            <td><?=$x=2?></td>
        </tr>
        <tr>
            <td>-</td>
            <td>Subtraction</td>
            <td>$x=2 | 5-x</td>
            <td><?=$x=2?></td>
        </tr>
        <tr>
            <td>*</td>
            <td>Product</td>
            <td>$x=4 | x*3</td>
            <td><?=$x=4; echo 5*$x?></td>
        </tr>
        <tr>
            <td>/</td>
            <td>Division</td>
            <td>15/5</td>
            <td><?=15/5?></td>
        </tr>
        <tr>
            <td>%</td>
            <td>Modulus</td>
            <td>5%2</td>
            <td><?=5%2?></td>
        </tr>
        <tr>
            <td>++</td>
            <td>Increment (post)</td>
            <td>$x=5 | x++</td>
            <td><?=$x=5; echo $x++?></td>
        </tr>
        <tr>
            <td>++</td>
            <td>Increment (pre)</td>
            <td>$x=5 | ++x</td>
            <td><?=$x=5; echo ++$x?></td>
        </tr>
        <tr>
            <td>--</td>
            <td>Decrement (post)</td>
            <td>$x=5 | x--</td>
            <td><?=$x=5; echo $x--?></td>
        </tr>
        <tr>
            <td>--</td>
            <td>Decrement (pre)</td>
            <td>$x=5 | --x</td>
            <td><?=$x=5; echo --$x?></td>
        </tr>
    </tbody>
</table>
<?php
include 'template/footer.php'; ?>
