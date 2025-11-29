<?php
$tittle = '19- Trait';
$descripcion = "A mechanism for code reuse in single inheritance languages.";

include_once 'template/header.php';

echo "<section>";

trait Hello {
    public function showHello($name){
        echo"<li><b>Welcome:</b>".$name."</li>";
    }
}

trait Adso {
    public function showAdso($code){
        echo"<li><b>Program:</b>".$code."</li>";
    }
}

class Department {
    use Hello, Adso;
    public function showDepartment($dep){
        echo"<li><b>Department:</b>".$dep."</li>";
    }
}

$hl = new Department;
$hl->showHello('Jeremias Springfield');
$hl->showAdso(2929061);
$hl->showDepartment('Caldas');




include_once 'template/footer.php';
