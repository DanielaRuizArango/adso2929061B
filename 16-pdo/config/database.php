<?php
try {
    $conx = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


function login($email, $password, $conx) {
    try {
        $sql = "SELECT * FROM users 
                WHERE email = :email AND password = :password 
                LIMIT 1";
        $stmt = $conx->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usr = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['uid'] = $usr['id'];
            return true;
        } else {
            $_SESSION['error'] = "El usuario no está registrado!";
            return false;
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $_SESSION['error'] = "Error en el sistema. Por favor intente más tarde.";
        return false;
    }
}


function listPets($conx) {
    try {
        $sql = "SELECT p.id AS id, 
                       p.name AS name, 
                       p.photo AS photo, 
                       s.name AS specie, 
                       b.name AS breed 
                FROM pets AS p
                JOIN species AS s ON s.id = p.specie_id
                JOIN breeds AS b ON b.id = p.breed_id";
        
        $stmt = $conx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("List pets error: " . $e->getMessage());
        return [];
    }
}