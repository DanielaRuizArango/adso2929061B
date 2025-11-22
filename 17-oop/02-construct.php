<?php

$tittle = "02- Construct";
$descripcion = "Special method that initializes a new object upon creation.";

include_once 'template/header.php';

echo "<section>";

class PlayList
{
    #Attrs
    public $name;
    public $artist = array();
    public $genre = array();
    public $image = array();
    public $year = array();


    public function __construct($name)
    {
        $this->name = $name;
    }
    public function setPlayList($artist, $genre, $image, $year)
    {
        $this->artist[] = $artist;
        $this->genre[] = $genre;
        $this->image[] = $image;
        $this->year[] = $year;
    }

    public function getPlayList (){
        echo "<h3>PlayList: $this->name</h3>
        <div style='display: flex; gap:0.4rem; flex-dorection: column'>";
        foreach($this->artist as $i => $artist){
            echo "<div style='flex; gap: 0.4rem; border: 2px solid #0009; background-color: #0003>
            <img src='{$this->image[$i]}' width='160px'>
            <div>
            <h4>Artist: {$artist}</h4>
            <h5>Genre: {$this->genre[$i]}</h5>
            <h5>Year:{$this->year[$i]}</h5>
            </div>
            </div>";
        }
        echo "</div>";
    }
}

$pl = new PlayList('Merry Christmas');
$pl-> setPlayList('Mariah Carey', 'Pop-Holiday','https://shortutl.at/usv3E', 1994);
$pl-> setPlayList('Wham!', 'Pop','https://shortutl.at/kfQAJ', 1984);
$pl-> setPlayList('Brenda Lee', 'Holiday','https://shortutl.at/OGBZI', 1958);

$pl->getPlayList();

include_once 'template/footer.php';

