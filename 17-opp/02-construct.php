<?php

    $tittle = "02 - Construct";
    $descripcion = "lorem ipsum dolor sit amet";

include_once 'template/header.php';

echo"<section>";

class PlayList{
    #Attrs
    public $artist;
    public $album;
    public $year;
    public $song;

    public function __construct($album,$year,$song,$artist = "Chayanne"){
        $this->artist = $artist;
        $this->album = $album;
        $this->year = $year;
        $this->song = $song;
}
}

$pl = new PlayList("Black Tshirt", 1998, "Nude Foots", "Shakira");
echo $pl-> artist;

include_once 'template/footer.php';