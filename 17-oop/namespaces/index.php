<?php
$tittle = '18- Namespace';
$descripcion = "Encapsulates items to avoid name conflicts between code.";

include_once '../template/header-l2.php';

echo "<section>";

include 'electric/Pokemon.php';
include 'fire/Pokemon.php';
include 'water/Pokemon.php';

use \electric\Pokemon as Pke;
use \fire\Pokemon as Pkf;
use \water\Pokemon as Pkw;

$pk = new Pke('Pikachu', 'Yellow');
echo $pk->getInfoPokemon();

$pk = new Pkf('Charmander', 'Orange');
echo $pk->getInfoPokemon();

$pk = new Pkw('Squirtle', 'Agua');
echo $pk->getInfoPokemon();

// include_once 'template/footer.php';
