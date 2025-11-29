<?php
$tittle = '13- Clone Object';
$descripcion = "Creating a new object as a copy of an existing one.";

include_once 'template/header.php';

echo "<section>";

class Dragon {
    private $name;
    private $weight;

    public function __construct($name, $weight) {
        $this->name   = $name;
        $this->weight = $weight;
    }

    public function getInfoDragon() {
        return "<li> Name: {$this->name} - Weight: {$this->weight} kg </li>";
    }
}

$dr  = new Dragon("Spyro", 3000);
$drc = clone($dr);
echo $drc->getInfoDragon();



include_once 'template/footer.php';
