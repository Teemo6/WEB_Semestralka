<?php

class DatabaseModel{
    private PDO $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->pdo->exec("set names utf8");
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage()."<br>";
            die();
        }
    }

    public function getAllUsers():array {
        $q = "SELECT * FROM ".TAB_UZIVATEL;
        return $this->pdo->query($q)->fetchAll();
    }
}

?>