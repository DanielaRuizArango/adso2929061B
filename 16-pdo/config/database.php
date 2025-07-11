<?php

try {
    $conx = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // recomendable para ver errores
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function login($email, $password, $conx) {
    try {
        $sql = "SELECT * 
                FROM users
                WHERE email = :email
                AND password = :password
                LIMIT 1";
        $stmt = $conx->prepare($sql);

        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usr = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['uid'] = $usr['id'];
            return true;
        } else {
            $_SESSION['error'] = "User not registered";
            return false;
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}