<?php
$tittle = '10- Method Abstract';
$descripcion = "A method declared without a body, requiring child implementation.";

include_once 'template/header.php';

echo "<section>";

abstract class VideoGame {
    protected $name;
    protected $platform;
    protected $year;

    public function __construct($nm, $pt, $yr) {
        $this->name     = $nm;
        $this->platform = $pt;
        $this->year     = $yr;
    }

    public abstract function getInfoVideoGame();
}

class Zelda extends VideoGame {
    public function getInfoVideoGame() {
        return $this->name." | ".$this->platform." | ".$this->year;
    }
}

$vg1 = new Zelda('Zelda Ocarine of Time', 'N64', 1998);
echo "<li>".$vg1->getInfoVideoGame()."</li>";

$vg2 = new Zelda('Zelda Majora Mask', 'N64', 2000);
echo "<li>".$vg2->getInfoVideoGame()."</li>";

$vg3 = new Zelda('Zelda Twilight Princess', 'NWii', 2006);
echo "<li>".$vg3->getInfoVideoGame()."</li>";

$vg4 = new Zelda('Zelda Breath of the Wild', 'NSwitch', 2017);
echo "<li>".$vg4->getInfoVideoGame()."</li>";

include_once 'template/footer.php';
