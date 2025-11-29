<?php
$tittle = '16- Method Static';
$descripcion = "A method called on the class itself, not on an instance.";

include_once 'template/header.php';

echo "<section>";

class Car {
    public $brand;
    public $refer;

    public static function showInfoCar($brand, $refer) {
        # Error: $this can not be used in static methods
        # $this->brand = $brand;

        return "<li> 
                    <b>Brand: </b> {$brand} 
                    <b>Reference: </b> {$refer}
                </li>";
    } 

}

echo Car::showInfoCar('Aston Martin', 'DB9');
echo Car::showInfoCar('Porshe', 'Carrera GT');
echo Car::showInfoCar('Lamborgini', 'Gallardo');



include_once 'template/footer.php';
