<?php

    $tittle = "08 - Oper Comparison";
    $descripcion = "Perform comparison operations on variables";

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
            <td>==</td>
            <td>Is equal</td>
            <td><?php echo '5==8 | '; var_dump(5==8)?></td>
        </tr>
        <tr>
            <td>!=</td>
            <td>Is not equal</td>
            <td><?php echo '5!=8 | '; var_dump(5!=8)?></td>
        </tr>
        <tr>
            <td><></td>
            <td>Is different</td>
            <td><?php echo '5<>8 | '; var_dump(5<>8)?></td>
        <tr>
            <td>></td>
            <td>Great than</td>
            <td><?php echo '5>8 | '; var_dump(5>8)?></td>
        </tr>
        <tr>
            <td><</td>
            <td>Less than</td>
            <td><?php echo '5<8 | '; var_dump(5<8)?></td>
        </tr>
        <tr>
            <td>>=</td>
            <td>Great than or equal</td>
            <td><?php echo '5>=8 | '; var_dump(5>=8)?></td>
        </tr>
    </tbody>
</table>
<?php
include 'template/footer.php'; ?>
