<?php
$tittle = '11- Class Final';
$descripcion = "A class that cannot be extended by any other class.";

include_once 'template/header.php';

echo "<section>";


final class Fruit
{
    private $name;
    private $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function showInfoFruit()
    {
        return "<li> 
                     <b>Name:</b>{$this->name}<br>
                     <b>Color:</b>{$this->color}
                </li>";
    }
}
# Error: Class Orange cannot extend final class Fruit
# class Orange extends Fruit { }
$fr = new Fruit('Pinapple', 'Yellow');
echo $fr->showInfoFruit();

$fr = new Fruit('Apple', 'Green');
echo $fr->showInfoFruit();

$fr = new Fruit('Blueberry', 'Dark Purple');
echo $fr->showInfoFruit();

include_once 'template/footer.php';
