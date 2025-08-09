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
    <title>Tu mejor amigo en casa - Show</title>
    <link rel="stylesheet" href="<?=$css?>master.css">
</head>
<body>
    <main class="show">
        <header>
            <h2>Consultar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>
        <?php 
            $id = $_GET['id'];
            $pet = showPet($id, $conx);
        ?>
        <figure class="photo-preview">
            <img id="preview" src="../uploads/<?=$pet['photo']?>" alt="">
        </figure>
        <div>
            <article class="info-name"><p><?=$pet['name']?></p></article>
            <article class="info-race"><p><?=$pet['specie']?></p></article>
            <article class="info-category"><p><?=$pet['breed']?></p></article>
            <article class="info-gender"><p><?=$pet['sex']?></p></article>
        </div>
    </main>
</body>
</html>