<?php
$tittle = '03- Private';
$descripcion = 'Restricts property or method access to only within its class.';

include_once 'template/header.php';

echo "<section>";

class RenderTable {
    private $nr; # Number of Rows
    private $nc; # Number of Columns

    public function __construct($nr, $nc)
    {
        $this->nr = $nr;
        $this->nc = $nc;

        //Access to private methods
        $this->openTable();
        $this->bodyTable();
        $this->closeTable();
    }
    private function openTable(){
        echo "<table>";
    }
    private function bodyTable(){
        echo"<h3> Table ({$this->nr} X {$this->nc})</h3>";
        for($r = 1; $r <= $this->nr; $r++){
            echo "<tr>";
            for($c = 1; $c <= $this->nc; $c++){
                echo "<td>f{$r}c{$c}</td>";
            }
            echo "</tr>";
        }
    }
    
    private function closeTable(){
        echo "</table>";
    }
}

$tbl = new RenderTable(5,5);
$tbl = new RenderTable(3,8);
$tbl = new RenderTable(2,2);

include_once 'template/footer.php';