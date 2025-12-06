<?php
abstract class Database {
    protected static $conn = null;

    public static function connect() {
        if (self:: $conn == null){
            try{
                $host = 'localhost';
                $dbmn = 'pokeadso';
                $user = 'root';
                $pass = '12345678';

                self::$conn = new PDO("mysql:host=$host;dbname=$dbmn;charset=utf8mb4", $user, $pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, value:PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Connection error: ". $e->getMessage());
            }
        }
        return self::$conn;
    }
    
}
