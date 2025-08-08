<?php
include '../config/app.php';
include '../config/database.php';
include '../config/security.php';

try {
    $conx = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function login($email, $password, $conx) {
    try {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
        $stmt = $conx->prepare($sql);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":password", $password);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $usr = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['uid'] = $usr['id'];
            return true;
        } else {
            $_SESSION['error'] = "El Usuario no esta registrado!";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function listPets($conx) {
    try {
        $sql = "SELECT p.id AS id, p.name AS name, p.photo AS photo, 
                s.name AS specie, b.name AS breed 
                FROM pets AS p, species AS s, breeds AS b 
                WHERE s.id = p.specie_id AND b.id = p.breed_id";
        $stmt = $conx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function listSpecies($conx) {
    try {
        $sql = "SELECT * FROM species";
        $stmt = $conx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function addPet($name, $specie_id, $breed_id, $sex_id, $photo, $conx) {
    try {
        $sql = "INSERT INTO pets (name, specie_id, breed_id, sex_id, photo) 
                VALUES (:name, :specie_id, :breed_id, :sex_id, :photo)";
        $stmt = $conx->prepare($sql);
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":specie_id", $specie_id);
        $stmt->bindparam(":breed_id", $breed_id);
        $stmt->bindparam(":sex_id", $sex_id);
        $stmt->bindparam(":photo", $photo);
        
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function listBreeds($conx) {
    try {
        $sql = "SELECT * FROM breeds";
        $stmt = $conx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function listSexes($conx) {
    try {
        $sql = "SELECT * FROM sexes";
        $stmt = $conx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
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
                        <img src="../uploads/<?=$pet['photo']?>" alt="<?=$pet['name']?>">
                    </figure>
                    <div class="info">
                        <h3><?=$pet['name']?></h3>
                        <h4>
                            <?=$pet['specie']?> - <?=$pet['breed']?>
                        </h4>
                    </div>
                    <div class="controls">
                        <a href="show.php?id=<?=$pet['id']?>" class="show" title="Ver detalles"></a>
                        <a href="edit.php?id=<?=$pet['id']?>" class="edit" title="Editar"></a>
                        <a href="javascript:deletePet(<?=$pet['id']?>, '<?=$pet['name']?>')" class="delete" title="Eliminar"></a>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </main>

    <script>
        function deletePet(id, name) {
            if(confirm(`¿Está usted seguro? Va a eliminar a ${name}`)) {
                window.location.replace('delete.php?id='+id);
            }
        }
    </script>
</body>
</html>