<?php
$tittle = '16- Loop Foreach';
$description = 'Loop that iterates over each element of an array';

include 'template/header.php';

echo "<section style='display: flex; gap: 0.2rem;'>";

$signs = array( '♈ Aries','♉ Taurus','♊ Gemini','♋ Cancer','♌ Leo','♍ Virgo','♎ Libra','♏ Scorpio','♐ Sagittarius','♑ Capricorn','♒ Aquarius','♓ Pisces');

// var_dump($signs);

foreach ($signs as $sign) {
    echo "<p>$sign</p>";
}

include 'template/footer.php';