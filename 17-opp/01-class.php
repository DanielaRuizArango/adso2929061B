<?php

    $tittle = "01 - Class";
    $descripcion = "lorem ipsum dolor sit amet";

include_once 'template/header.php';

echo"<section>";

class Vehicle {
    # Attributes
    public $brand;
    public $refer;
    public $color;
    public $model;

    # Methods 
    public function setAttributes($brand, $refer, $color, $model){
        $this->brand = $brand;
        $this->refer = $refer;
        $this->color = $color;
        $this->model = $model;
    }

    public function getAttributes(){
        return "<ul> 
        <li>Brand: $this->brand</li>
        <li>Refer: $this->refer</li>
        <li>Color: $this->color</li>
        <li>Model: $this->model</li>
        </ul>";
    }
}

$vehicle1 = new Vehicle;
$vehicle1->setAttributes('Volkswagen', 'Golf', 'Black', '2020');
echo $vehicle1->getAttributes();

$vehicle2 = new Vehicle;
$vehicle2->setAttributes('Nissan', 'Murano', 'Gray', '2022');
$vehicle2->refer = 'Kicks';
echo $vehicle2->getAttributes();

$vehicle3 = new Vehicle;
$vehicle3->brand = "Toyota";
$vehicle3->refer = "Foreruner";
$vehicle3->color = "Orange";
$vehicle3->model = "2010";
echo $vehicle3->getAttributes();


include_once 'template/footer.php';
