<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    $pet = showPet($id, $conx);
    
    $species = listSpecies($conx);
    $breeds = listBreeds($conx);
    $sexes = listSexes($conx);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $specie_id = $_POST['specie_id'];
        $breed_id = $_POST['breed_id'];
        $sex_id = $_POST['sex_id'];
        
        $photo = $pet['photo'];
        
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileExtension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = 'pet_' . $id . '_' . time() . '.' . $fileExtension;
                $uploadPath = $uploadDir . $newFileName;
                
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
                    $photo = $newFileName;  
                    if ($pet['photo'] && $pet['photo'] !== $newFileName && file_exists($uploadDir . $pet['photo'])) {
                        unlink($uploadDir . $pet['photo']);
                    }
                } else {
                    $_SESSION['error'] = "Error al subir la imagen";
                }
            } else {
                $_SESSION['error'] = "Formato de imagen no válido. Use: " . implode(', ', $allowedExtensions);
            }
        }
        
        if (editPet($id, $name, $specie_id, $breed_id, $sex_id, $photo, $conx)) {
            $_SESSION['message'] = "Mascota actualizada exitosamente";
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Error al actualizar la mascota";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Edit</title>
    <link rel="stylesheet" href="<?=$css?>master.css">
</head>
<body>
    <main class="edit">
        <header>
            <h2>Modificar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>
        <figure class="photo-preview">
            <?php if ($pet['photo'] && file_exists('../uploads/' . $pet['photo'])): ?>
                <img id="preview" src="../uploads/<?=$pet['photo']?>" alt="Foto de <?=$pet['name']?>">
            <?php else: ?>
                <img id="preview" src="<?=$imgs?>/photo-lg-0.svg" alt="Sin foto">
            <?php endif; ?>
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nombre" value="<?=$pet['name']?>">
            <div class="select">
                <select name="specie_id">
                    <option value="">Seleccione Categoría...</option>
                    <?php foreach($species as $specie): ?>
                        <option value="<?=$specie['id']?>" <?=($specie['id'] == $pet['specie_id']) ? 'selected' : ''?>>
                            <?=$specie['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="select">
                <select name="breed_id">
                    <option value="">Seleccione Raza...</option>
                    <?php foreach($breeds as $breed): ?>
                        <option value="<?=$breed['id']?>" <?=($breed['id'] == $pet['breed_id']) ? 'selected' : ''?>>
                            <?=$breed['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="button" class="upload">Subir Foto</button>
            <input type="file" name="photo" id="photo" accept="image/*" style="display: none;">
            <div class="select">
                <select name="sex_id">
                    <option value="">Seleccione Genero...</option>
                    <?php foreach($sexes as $sex): ?>
                        <option value="<?=$sex['id']?>" <?=($sex['id'] == $pet['sex_id']) ? 'selected' : ''?>>
                            <?=$sex['name']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="update">Modificar</button>
        </form>
    </main>
    
    <script>
        document.querySelector('.upload').addEventListener('click', function() {
            document.getElementById('photo').click();
        });
        
        document.getElementById('photo').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        <?php if (isset($_SESSION['error'])): ?>
            alert('<?=$_SESSION['error']?>');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['message'])): ?>
            alert('<?=$_SESSION['message']?>');
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </script>
</body>
</html>