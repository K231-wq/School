<?php 
namespace App;

use PDO;
use Exception;
class Database{
    public \PDO $pdo;
    public static Database $db;
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=school", "root", 
    );
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$db = $this;
    }

    public function userSchema(){
        try{
            $sql = "CREATE TABLE IF NOT EXISTS USER (
                id int AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL UNIQUE,
                imagePath LONGTEXT NOT NULL,
                password varchar(255) NOT NULL
            )";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        }catch(Exception $e){
            echo "User Schema: " . $e->getMessage();
        }
    }
}
?>