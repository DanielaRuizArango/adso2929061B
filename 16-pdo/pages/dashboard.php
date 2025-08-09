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
    <title>Tu mejor amigo en casa - Dashboard</title>
    <link rel="stylesheet" href="<?=$css?>master.css">
</head>
<body>
    <main class="dashboard">
        <header>
            <h2>Administrar Mascotas</h2>
            <a href="../close.php" class="close"></a>
        </header>
       <a href="add.php" class="add"></a>   
       <table>
            <?php $pets = listPets($conx); ?>
            <?php foreach($pets as $pet): ?>
           <tr>
               <td>
                    <figure class="photo">
                        <img src="../uploads/<?=$pet['photo']?>" alt="">
                    </figure>
                    <div class="info">
                        <h3><?=$pet['name']?></h3>
                        <h4>
                            <?=$pet['specie']?> -
                            <?=$pet['breed']?>
                        </h4>
                    </div>
                    <div class="controls">
                        <a href="show.php?id=<?=$pet['id']?>" class="show"></a>
                        <a href="edit.php?id=<?=$pet['id']?>" class="edit"></a>
                        <a href="javascript:deletePet(<?=$pet['id']?>, '<?=$pet['name']?>')" class="delete"></a>
                    </div>
               </td>
           </tr>
            <?php endforeach ?>
            <?php 
                if(isset($_SESSION['message'])) {
                    include 'message.php';
                    unset($_SESSION['message']);
                }
            ?>
       </table>
    </main>
</body>
        <script>
            function deletePet(id, name) {
            
                if(confirm(`Esta usted seguro? Va eliminar a ${name}`)) {
                    window.location.replace('delete.php?id='+id)
                }
            }
        </script>
</html>