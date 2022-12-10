<?php

class DatabaseModel{
    protected PDO $pdo;

    /**
     * Řeší připojení k databázi
     */
    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->pdo->exec("set names utf8");
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage()."<br>";
            die();
        }
    }
}

?>