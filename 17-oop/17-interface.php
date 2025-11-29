<?php
$tittle = '17- Interface';
$descripcion = "A contract specifying which methods a class must implement.";

include_once 'template/header.php';

echo "<section>";

include_once 'template/frm-upload.php';

interface Image {
    public function uploadImage($file);
}

class Upload implements Image {
    private $file;

    public function uploadImage($file) {
        $this->file = $file;
        move_uploaded_file($_FILES['image']['tmp_name'], $this->file);
        echo "<li> Upload Image Successfully! </li>";
    }
}
if ($_FILES) {
    $ui = new Upload();
    $ui->uploadImage('uploads/'.$_FILES['image']['name']);
}

include_once 'template/js-upload.php';



include_once 'template/footer.php';
