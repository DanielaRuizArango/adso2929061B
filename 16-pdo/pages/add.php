<?php 
include '../config/app.php';
include '../config/database.php';
include '../config/security.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Add</title>
    <link rel="stylesheet" href="<?=$css?>master.css">
</head>
<body>
    <main class="add">
        <header>
            <h2>Adicionar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>

        <figure class="photo-preview">
            <img id="preview" src="<?=$imgs?>/photo-lg-0.svg" alt="Vista previa de foto">
        </figure>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Campo Nombre -->
            <input type="text" name="name" placeholder="Nombre" autocomplete="off" 
                   value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            
            <!-- Selector de Especie -->
            <div class="select">
                <select name="specie_id">
                    <option value="">Seleccione Especie...</option>
                    <?php $species = listSpecies($conx) ?>
                    <?php foreach($species as $specie): ?>
                        <option value="<?=$specie['id']?>" 
                            <?= (isset($_POST['specie_id']) && $_POST['specie_id'] == $specie['id']) ? 'selected' : '' ?>>
                            <?=$specie['id']?>-<?=$specie['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <!-- Selector de Raza -->
            <div class="select">
                <select name="breed_id">
                    <option value="">Seleccione Raza...</option>
                    <?php $breeds = listBreeds($conx) ?>
                    <?php foreach($breeds as $breed): ?>
                        <option value="<?=$breed['id']?>" 
                            <?= (isset($_POST['breed_id']) && $_POST['breed_id'] == $breed['id']) ? 'selected' : '' ?>>
                            <?=$breed['id']?>-<?=$breed['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <!-- Foto -->
            <button type="button" class="upload">Subir Foto</button>
            <input type="file" name="photo" id="photo" accept="image/*" style="display: none;">
            
            <!-- Selector de Género -->
            <div class="select">
                <select name="sex_id">
                    <option value="">Seleccione Genero...</option>
                    <?php $sexes = listSexes($conx) ?>
                    <?php foreach($sexes as $sex): ?>
                        <option value="<?=$sex['id']?>" 
                            <?= (isset($_POST['sex_id']) && $_POST['sex_id'] == $sex['id']) ? 'selected' : '' ?>>
                            <?=$sex['id']?>-<?=$sex['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <button type="submit" class="save">Guardar</button>
        </form>

        <?php
        // Procesamiento del formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = 0;
            
            // Validación de campos requeridos
            foreach ($_POST as $key => $value) {
                if(empty($value)) {
                    $errors++;
                }
            }
            
            // Validación de archivo
            if(!isset($_FILES['photo']) || !file_exists($_FILES['photo']['tmp_name'])) {
                $errors++;
            }
            
            if($errors == 0) {
                $name = $_POST['name'];
                $specie_id = $_POST['specie_id'];
                $breed_id = $_POST['breed_id'];
                $sex_id = $_POST['sex_id'];
                
                // Procesamiento de la imagen
                $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $photo = time().".".$ext;
                $targetPath = "../uploads/".$photo;
                
                if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                    if(addPet($name, $specie_id, $breed_id, $sex_id, $photo, $conx)) {
                        $_SESSION['message'] = "La Mascota $name se adicionó con éxito!";
                        echo "<script>window.location.replace('dashboard.php')</script>";
                    }
                }
            } else {
                $_SESSION['error'] = "Todos los campos son requeridos!";
            }
        }
        
        // Mostrar errores si existen
        if(isset($_SESSION['error'])) {
            include 'errors.php';
            unset($_SESSION['error']);
        }
        ?>
    </main>

    <script>
        // Manejo de la vista previa de la imagen
        const preview = document.querySelector('#preview');
        const upload = document.querySelector('.upload');
        const photo = document.querySelector('#photo');
        
        upload.addEventListener('click', function() {
            photo.click();
        });
        
        photo.addEventListener('change', function() {
            if(this.files && this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
            }
        });
    </script>
</body>
</html>