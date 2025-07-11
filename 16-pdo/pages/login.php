<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Login</title>
    <link rel="stylesheet" href="<?=$css?>master.css">
</head>
<body>
    <main class="login">
        <form action="" method="post">
            <input type="text" name="email" placeholder="Correo Electrónico">
            <input type="password" name="password" placeholder="Contraseña">
            <button>Ingresar</button>
        </form>
        <?php 
            if($_POST){
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                // var_dump($_POST);

                if(login($email, $password, $conx)) {
                     echo "<script>window.location.replace('pages/dashboard.php')</script>";
                }
            }

            if(isset($_SESSION['error'])) {
                include 'errors.php';
                unset($_SESSION['error']);
            }
        ?>
    </main>
</body>
</html>