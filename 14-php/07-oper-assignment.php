<?php

    $tittle = "07 - Oper Assignment";
    $descripcion = "Perform assignment operations on variables";

include 'template/header.php';
    echo '<section>';

?>
<table>
    <thead>
        <tr>
            <th>Operator</th>
            <th>Example</th>
            <th>Is equal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>=</td>
            <td>$x=y</td>
            <td><?=$x=$y?></td>
        </tr>
        <tr>
            <td>+=</td>
            <td>$x+=y</td>
            <td><?=$x=2; echo $x+=3?></td>
        </tr>
        <tr>
            <td>-=</td>
            <td>$x-=y</td>
            <td><?=$x=5; echo $x-=2?></td>
        </tr>
        <tr>
            <td>*=</td>
            <td>$x*=y</td>
            <td><?=$x=4; echo $x*=3?></td>
        </tr>
        <tr>
            <td>/=</td>
            <td>$x/=y</td>
            <td><?=$x=12; echo $x/=4?></td>
        </tr>
        <tr>
            <td>.=</td>
            <td>$x.=y</td>
            <td><?=$x="Hello"; echo $x.=" World"?></td>
        </tr>
        <tr>
            <td>%=</td>
            <td>$x%=y</td>
            <td><?=$x=5; echo $x%=2?></td>
        </tr>
    </tbody>
</table>
<?php
include 'template/footer.php'; ?>
